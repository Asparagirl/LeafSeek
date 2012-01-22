<?php

	// DOUBLE CHECK THAT WE ARE SENDING OUT UTF-8
	header('Content-type: text/html; charset=UTF-8');
	
	// TURN ON GZIP COMPRESSION TO MAKE THE PAGE FASTER
	ob_start("ob_gzhandler");
	
	// INCLUDE THE LANGUAGE LOCALIZATION CODE (OPTIONAL)
	include('_includes/localization.php');

	// TURN ON ERROR REPORTING (ONLY WHILE IN DEVELOPMENT -- TURN THIS OFF FOR LIVE SITES)
	error_reporting(E_ALL);
	ini_set('display_errors','On');

	// MAKE SOLARIUM AVAILABLE
	require('solarium_v2.3.0/Autoloader.php');
	Solarium_Autoloader::register();

	// CREATE A NEW CLIENT INSTANCE
	$config = array(
    'adapteroptions' => array(
	
		// ENTER YOUR LIVE LEAFSEEK BACKEND WEBSITE HERE, IF YOU'RE USING LIVE DATA:
    'host' => 'localhost',
    'port' => 8080,
		'path' => '/solr/',
		
		// ...OR YOU CAN ENTER YOUR PERSONAL COMPUTER'S INFORMATION HERE, IF YOU'RE USING TEST DATA:
		//'host' => 'localhost',
    //'port' => 8983,
    //'path' => '/solr/',
		
		// ONE OF THESE OPTIONS MUST BE TURNED ON AND ONE MUST BE COMMENTED OUT -- IT'S UP TO YOU TO PICK ONE!
		
		)
	);
	$client = new Solarium_Client($config);
	
	// QUERY TIME!
	$query = $client->createSelect();
	$query->setRows(40);
	
	// ADD SORTING
	$querySort = '';
	if ( (isset($_REQUEST['querySort'])) && (($_REQUEST['querySort'])!=='') ) {
		$querySort = ($_REQUEST['querySort']);
		// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
		if (function_exists('newrelic_add_custom_parameter')) { newrelic_add_custom_parameter('Sort', $querySort); };
		// What kind of sort should we do?
		if ($querySort == 'typeASCyearASC') {
			$query->addSort('record_type', Solarium_Query_Select::SORT_ASC);
			$query->addSort('Year', Solarium_Query_Select::SORT_ASC);
			// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
			if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Sorts/typeASCyearASC', '1'); };
		} else if ($querySort == 'typeASCyearDESC') {
			$query->addSort('record_type', Solarium_Query_Select::SORT_ASC);
			$query->addSort('Year', Solarium_Query_Select::SORT_DESC);
			// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
			if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Sorts/typeASCyearDESC', '1'); };
		} else if ($querySort == 'yearASCtypeASC') {
			$query->addSort('Year', Solarium_Query_Select::SORT_ASC);
			$query->addSort('record_type', Solarium_Query_Select::SORT_ASC);
			// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
			if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Sorts/yearASCtypeASC', '1'); };
		} else if ($querySort == 'yearASCtypeDESC') {
			$query->addSort('Year', Solarium_Query_Select::SORT_ASC);
			$query->addSort('record_type', Solarium_Query_Select::SORT_DESC);
			// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
			if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Sorts/yearASCtypeDESC', '1'); };
		}
	}
	
	
	// ADD GEOGRAPHIC SORT
	$queryGeographicSortRange = '';
	$queryGeographicSortTown = '';
	if ( (isset($_REQUEST['queryGeographicSortRange'])) && (($_REQUEST['queryGeographicSortRange'])!=='') && (isset($_REQUEST['queryGeographicSortTown'])) && (($_REQUEST['queryGeographicSortTown'])!=='') ) {
		$queryGeographicSortRange = ($_REQUEST['queryGeographicSortRange']);
		$queryGeographicSortTown = ($_REQUEST['queryGeographicSortTown']);
		// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
		if (function_exists('newrelic_add_custom_parameter')) { newrelic_add_custom_parameter('Location', $queryGeographicSortTown); };
		// split up the latitude and longitude from the passed value
		$queryGeographicSortTownPart = explode(", ", $queryGeographicSortTown);
		$helper = $query->getHelper();
		$query->setQuery($helper->geofilt($queryGeographicSortTownPart[0], $queryGeographicSortTownPart[1], 'record_latlong', $queryGeographicSortRange));
	}

	
	// ADD SURNAME FILTER QUERY
	$querySurname = '';
	$filterQuerySurname = $query->createFilterQuery();
	$filterQuerySurname->setKey('SearchSurname');
	if ( (isset($_REQUEST['querySurname'])) && (($_REQUEST['querySurname'])!=='') ) {
		// make the input lowercase
		$querySurname = strtolower($_REQUEST['querySurname']);
		// strip out existing query stuff, if it's there, so that we don't duplicate accidentally
		$querySurname = str_replace("record_surnames:", "", $querySurname);
		// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
		if (function_exists('newrelic_add_custom_parameter')) { newrelic_add_custom_parameter('Surname', $querySurname); };
		if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Searches/Surname', '1'); };
		// okay, now add in the query stuff
		$querySurname = 'record_surnames:'.$querySurname;
		$filterQuerySurname->setQuery($querySurname);
	} else {
		$filterQuerySurname->setQuery('record_surnames:*');
	}
	$query->addfilterQuery($filterQuerySurname);
	
	// ADD GIVEN NAME FILTER QUERY
	$queryGivenName = '';
	$filterQueryGivenName = $query->createFilterQuery();
	$filterQueryGivenName->setKey('SearchGivenName');
	if ( (isset($_REQUEST['queryGivenName'])) && (($_REQUEST['queryGivenName'])!=='') ) {
		// make the input lowercase
		$queryGivenName = strtolower($_REQUEST['queryGivenName']);
		// strip out existing query stuff, if it's there, so that we don't duplicate accidentally
		$queryGivenName = str_replace("record_givennames:", "", $queryGivenName);
		// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
		if (function_exists('newrelic_add_custom_parameter')) { newrelic_add_custom_parameter('GivenName', $queryGivenName); };
		if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Searches/GivenName', '1'); };
		// okay, now add in the query stuff
		$queryGivenName = 'record_givennames:'.$queryGivenName;
		$filterQueryGivenName->setQuery($queryGivenName);
	} else {
		$filterQueryGivenName->setQuery('record_givennames:*');
	}
	$query->addfilterQuery($filterQueryGivenName);
	
	
	// ADD VARIOUS FACET FIELDS
	// get the facetset component
	$facetSet = $query->getFacetSet();
	
	// ADD SURNAME FACETS
	$surnameFacet = $facetSet->createFacetField();
	$surnameFacet->setKey('FacetSurname')
				->setField('record_surnames')
				->setMinCount(1)
				->setLimit(15);
	$facetSet->addFacet($surnameFacet);
	
	// GIVEN NAME FACETS
	$givennameFacet = $facetSet->createFacetField();
	$givennameFacet->setKey('FacetGivenName')
				->setField('record_givennames')
				->setMinCount(1)
				->setLimit(15);
	$facetSet->addFacet($givennameFacet);
	
	// TOWN FACETS
	$townFacet = $facetSet->createFacetField();
	$townFacet->setKey('FacetTown')
				->setField('Town')
				//->setSort('ASC')
				->setMinCount(5);
				//->setLimit(10);
	$facetSet->addFacet($townFacet);
	$queryTown = '';
	if ( (isset($_REQUEST['queryTown'])) && (($_REQUEST['queryTown'])!=='') ) {
		// make the input lowercase
		$queryTown = strtolower($_REQUEST['queryTown']);
		// strip out existing query stuff, if it's there, so that we don't duplicate accidentally
		$queryTown = str_replace("Town:", "", $queryTown);
		// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
		if (function_exists('newrelic_add_custom_parameter')) { newrelic_add_custom_parameter('Town', $queryTown); };
		if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Searches/Town', '1'); };
		// okay, now add in the query stuff
		$filterQueryTown = $query->createFilterQuery();
		$filterQueryTown->setKey('queryTown');
		$filterQueryTown->setQuery('Town:"'.$queryTown.'"');
		$query->addFilterQuery($filterQueryTown);
	}
	
	// ALL LOCATION FACETS
	$locationFacet = $facetSet->createFacetField();
	$locationFacet->setKey('FacetLocation')
				->setField('record_towns')
				->setMinCount(1)
				->setLimit(50);
	$facetSet->addFacet($locationFacet);
	$queryLocation = '';
	if ( (isset($_REQUEST['queryLocation'])) && (($_REQUEST['queryLocation'])!=='') ) {
		// make the input lowercase
		$queryLocation = strtolower($_REQUEST['queryLocation']);
		// strip out existing query stuff, if it's there, so that we don't duplicate accidentally
		$queryLocation = str_replace("record_towns:", "", $queryLocation);
		// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
		if (function_exists('newrelic_add_custom_parameter')) { newrelic_add_custom_parameter('Location', $queryLocation); };
		if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Searches/Location', '1'); };
		// okay, now add in the query stuff
		$filterQueryLocation = $query->createFilterQuery();
		$filterQueryLocation->setKey('queryLocation');
		$filterQueryLocation->setQuery('record_towns:"'.$queryLocation.'"');
		$query->addFilterQuery($filterQueryLocation);
	}
	
	// YEAR FACETS
	$yearFacet = $facetSet->createFacetField();
	$yearFacet->setKey('FacetYear')
				//->setField('Year')
				->setField('record_years')
				->setSort('ASC')
				->setMinCount(1);
	$facetSet->addFacet($yearFacet);
	$queryYear = '';
	if ( (isset($_REQUEST['queryYear'])) && (($_REQUEST['queryYear'])!=='') ) {
		// make the input lowercase
		$queryYear = strtolower($_REQUEST['queryYear']);
		// strip out existing query stuff, if it's there, so that we don't duplicate accidentally
		$queryYear = str_replace("record_years:", "", $queryYear);
		// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
		if (function_exists('newrelic_add_custom_parameter')) { newrelic_add_custom_parameter('Year', $queryYear); };
		if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Searches/Year', '1'); };
		// okay, now add in the query stuff
		$filterQueryYear = $query->createFilterQuery();
		$filterQueryYear->setKey('queryYear');
		$filterQueryYear->setQuery('record_years:"'.$queryYear.'"');
		$query->addFilterQuery($filterQueryYear);
	}
	
	// TYPE FACETS
	$typeFacet = $facetSet->createFacetField();
	$typeFacet->setKey('FacetType')
				->setField('record_type')
				->setSort('ASC')
				->setMinCount(1);
	$facetSet->addFacet($typeFacet);
	$queryType = '';
	if ( (isset($_REQUEST['queryType'])) && (($_REQUEST['queryType'])!=='') ) {
		// make the input lowercase
		$queryType = strtolower($_REQUEST['queryType']);
		// strip out existing query stuff, if it's there, so that we don't duplicate accidentally
		$queryType = str_replace("record_type:", "", $queryType);
		// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
		if (function_exists('newrelic_add_custom_parameter')) { newrelic_add_custom_parameter('Type', $queryType); };
		if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Searches/Type', '1'); };
		// okay, now add in the query stuff
		$filterQueryType = $query->createFilterQuery();
		$filterQueryType->setKey('queryType');
		$filterQueryType->setQuery('record_type:"'.$queryType.'"');
		$query->addFilterQuery($filterQueryType);
	}
	
	// SOURCE FACETS
	$sourceFacet = $facetSet->createFacetField();
	$sourceFacet->setKey('FacetSource')
				->setField('record_source')
				->setSort('ASC')
				->setMinCount(1);
	$facetSet->addFacet($sourceFacet);
	$querySource = '';
	if ( (isset($_REQUEST['querySource'])) && (($_REQUEST['querySource'])!=='') ) {
		$querySource = ($_REQUEST['querySource']);
		// strip out existing query stuff, if it's there, so that we don't duplicate accidentally
		$querySource = str_replace("record_source:", "", $querySource);
		// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
		if (function_exists('newrelic_add_custom_parameter')) { newrelic_add_custom_parameter('Source', $querySource); };
		if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Searches/Source', '1'); };
		// okay, now add in the query stuff
		$filterQuerySource = $query->createFilterQuery();
		$filterQuerySource->setKey('querySource');
		$filterQuerySource->setQuery('record_source:"'.$querySource.'"');
		$query->addFilterQuery($filterQuerySource);
	}
	
	// REPOSITORY FACETS
	$repositoryFacet = $facetSet->createFacetField();
	$repositoryFacet->setKey('FacetRepository')
				->setField('record_repository')
				->setSort('ASC')
				->setMinCount(1);
	$facetSet->addFacet($repositoryFacet);
	$queryRepository = '';
	if ( (isset($_REQUEST['queryRepository'])) && (($_REQUEST['queryRepository'])!=='') ) {
		$queryRepository = ($_REQUEST['queryRepository']);
		// strip out existing query stuff, if it's there, so that we don't duplicate accidentally
		$queryRepository = str_replace("record_repository:", "", $queryRepository);
		// log stuff to New Relic (www.newrelic.com), if that's a tool you're using to monitor your app
		if (function_exists('newrelic_add_custom_parameter')) { newrelic_add_custom_parameter('Repository', $queryRepository); };
		if (function_exists('newrelic_custom_metric')) { newrelic_custom_metric('Custom/Searches/Repository', '1'); };
		// okay, now add in the query stuff
		$filterQueryRepository = $query->createFilterQuery();
		$filterQueryRepository->setKey('queryRepository');
		$filterQueryRepository->setQuery('record_repository:"'.$queryRepository.'"');
		$query->addFilterQuery($filterQueryRepository);
	}
	
	// PAGINATION
	$start = 0;
	if ( (isset($_REQUEST['start'])) && (($_REQUEST['start'])!=='') ) {
		$start = $_REQUEST['start'];
		$query->setStart($start);
	}	

	
	// OKAY, NOW MAKE THE QUERY!
	$resultset = $client->select($query);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>YOUR WEBSITE NAME HERE</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<?php /* If we're using New Relic (www.newrelic.com) to monitor the app, add the header code now */ if (function_exists('newrelic_get_browser_timing_header')) { echo newrelic_get_browser_timing_header(); }; ?>
	
	<meta name="description" content="YOUR WEBSITE DESCRIPTION HERE" />
	
	<link href="_css/styles.css" rel="stylesheet" type="text/css" media="screen" />
    	<!--[if (IE 8)]>
    	<link href="_css/styles_ie8.css" rel="stylesheet" type="text/css" media="screen" />
    	<![endif]-->
    	<!--[if (IE 7)]>
    	<link href="_css/styles_ie7.css" rel="stylesheet" type="text/css" media="screen" />
    	<![endif]-->
	<link href="_css/print.css" rel="stylesheet" type="text/css" media="print" />
	
	<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript">
		if (typeof jQuery == 'undefined') {
			document.write(unescape("%3Cscript src='_js/jquery-1.7.1.min.js' type='text/javascript'%3E%3C/script%3E"));
		}
    	</script>
    	<!--[if (gte IE 6)&(lte IE 8)]>
	<script type="text/javascript" src="_js/selectivizr-min.js"></script>
	<![endif]-->
	
	<script type="text/javascript" charset="utf-8">
		// FOR THE PLACEHOLDER TEXT IN THE SEARCH INPUT FIELDS THAT GOES AWAY WHEN YOU TYPE IN THEM
		$(function(){
			$('[placeholder]').focus(function() {
  				var input = $(this);
  				if (input.val() == input.attr('placeholder')) {
   					input.val('');
    				input.removeClass('placeholder');
  				}
			}).blur(function() {
  				var input = $(this);
  				if (input.val() == '' || input.val() == input.attr('placeholder')) {
    				input.addClass('placeholder');
    				input.val(input.attr('placeholder'));
  				}
			}).blur().parents('form').submit(function() {
  				$(this).find('[placeholder]').each(function() {
    				var input = $(this);
    				if (input.val() == input.attr('placeholder')) {
     	 				input.val('');
    				}
  				})
			});
		});
	</script>
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			// SHOW AND HIDE THE INSTRUCTIONS
			$('#instructions-toggle').click(function() {
				$('#instructions').toggle(800);
				$(this).text($(this).text() == '[<?php echo _("read instructions and notes"); ?>]' ? '[<?php echo _("hide instructions and notes"); ?>]' : '[<?php echo _("read instructions and notes"); ?>]');
				return false;
			});
			// SHOW AND HIDE THE RECORD INFORMATION
			$('.result .result-header').click(function() {
				$(this).nextAll(".result .result-body, .result .result-footer").toggle(400);
				//$(this).nextAll(".result h3 .result-expand-plus").removeClass('result-expand-plus').addClass('result-expand-minus');
				return false;
			});
		});
	</script>
	
	<?php 
		// INCLUDE THIS FILE IF YOU WANT TO USE POP-UP GOOGLE MAPS
		// include('_includes/header_colorbox.php'); 
	?>
    
	<?php 
		// INCLUDE THIS FILE IF YOU WANT TO USE TYPEKIT FOR YOUR WEB FONTS
		// include('_includes/header_typekit.php'); 
	?>
	
</head>

<body>

<div id="wrapper">

	<?php include('_includes/header.php'); ?>

	<?php include('_includes/news.php'); ?>
	
	<div id="search">
		<h2><?php echo _("Enter your search"); ?>:</h2>
		<form id="formMain" accept-charset="utf-8" method="post">
        	<input type="hidden" id="queryTown" name="queryTown" value="" />
        
        	<div class="search-names">
				<label for="queryGivenName"><?php echo _("Given Name"); ?></label>
				<input id="queryGivenName" name="queryGivenName" type="text" class="search-givenname placeholder" placeholder="<?php echo _("Enter Given Name (optional)"); ?>" title="<?php echo _("Enter Given Name (optional)"); ?>"/>
            	<br />
				<label for="querySurname"><?php echo _("Surname"); ?></label>
				<input id="querySurname" name="querySurname" type="text" class="search-surname placeholder" placeholder="<?php echo _("Enter Surname (optional)"); ?>" title="<?php echo _("Enter Surname (optional)"); ?>"/>
            </div>
            <div class="search-options">
            	<div class="search-location">
                    <label for="queryGeographicSortRange">
                    <?php echo _("Within"); ?> 
                    <select id="queryGeographicSortRange" name="queryGeographicSortRange">
                        <option value="" class="optional">(<?php echo _("optional"); ?>)</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="75">75</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        <option value="500">500</option>
                    </select>
                     <?php echo _("kilometers of"); ?> 
                    <select id="queryGeographicSortTown" name="queryGeographicSortTown">
                        <option value="" class="optional">(<?php echo _("optional"); ?>)</option>
                        <option value="49.616667, 24.233333">Bibrka (Bóbrka), Ukraine</option>
                        <option value="49.966667, 20.433333">Bochnia, Poland</option>
                        <option value="48.808056, 24.538056">Bohorodchany (Bohorodczany), Ukraine</option>
                        <option value="48.802778, 26.036389">Borschiv (Borszczów), Ukraine</option>
                        <option value="50.083333, 25.15">Brody, Ukraine</option>
                        <option value="49.016667, 25.8">Chortkiv (Czortków), Ukraine</option>
                        <option value="49.35, 23.5">Drohobych (Drohobycz), Ukraine</option>
                        <option value="48.6675, 25.500278">Horodenka, Ukraine</option>
                        <option value="48.916667, 24.716667">Ivano-Frankivsk (Stanisławów), Ukraine</option>
                        <option value="50.016667, 22.666667">Jarosław, Poland</option>
                        <option value="50.1, 24.35">Kamianka-Buzka (Kamianka Strumilowa), Ukraine</option>
                        <option value="48.315, 25.095278">Kosiv (Kosów), Ukraine</option>
                        <option value="48.530556, 25.040278">Kolomyya (Kolomea), Ukraine</option>
                        <option value="50.061389, 19.938333">Kraków, Poland</option>
                        <option value="50.066667, 22.233333">Łańcut, Poland</option>
                        <option value="49.85, 24.016667">Lviv (Lwów, Lemberg), Ukraine</option>
                        <option value="50.283333, 21.416667">Mielec, Poland</option>
                        <option value="48.633333, 24.583333">Nadvirna (Nadwórna), Ukraine</option>
                        <option value="49.633333, 20.716667">Nowy Sącz (Neu Sandez), Poland</option>
                        <option value="49.5, 20.033333">Nowy Targ, Poland</option>
                        <option value="49.269444, 25.136111">Pidhaitsi (Podhajce), Ukraine</option>
                        <option value="49.786111, 22.773889">Przemyśl, Poland</option>
                        <option value="50.25, 23.616667">Rava-Ruska (Rawa Ruska), Ukraine</option>
                        <option value="49.416667, 24.616667">Rohatyn, Ukraine</option>
                        <option value="50.033333, 22">Rzeszów, Poland</option>
                        <option value="48.45, 25.566667">Sniatyn, Ukraine</option>
                        <option value="50.483333, 24.283333">Sokal, Ukraine</option>
                        <option value="49.443056, 23.003333">Staryi Sambir (Stary Sambor), Ukraine</option>
                        <option value="49.25, 23.85">Stryi (Stryj), Ukraine</option>
                        <option value="50.0125, 20.988611">Tarnów, Poland</option>
                        <option value="50.583333, 21.683333">Tarnobrzeg, Poland</option>
                        <option value="49.566667, 25.6">Ternopil (Tarnopol), Ukraine</option>
                        <option value="49.883333, 19.483333">Wadowice, Poland</option>
                        <option value="49.946944, 23.393056">Yavoriv (Jaworów), Ukraine</option>
                        <option value="49.666667, 25.777778">Zbarazh (Zbaraż), Ukraine</option>
                        <option value="49.808333, 24.901111">Zolochiv (Złoczów), Ukraine</option>
                    </select>
                    </label>
                </div>
                <div class="search-sort">
                	<label for="querySort"><?php echo _("Sort results by"); ?>:
                    <select id="querySort" name="querySort">
                    	<option value="" class="optional">(<?php echo _("optional"); ?>)</option>
                    	<option value="typeASCyearASC"><?php echo _("Record Type (A to Z), then Record Year (oldest to newest)"); ?></option>
                        <option value="typeDESCyearASC"><?php echo _("Record Type (Z to A), then Record Year (oldest to newest)"); ?></option>
                        <option value="yearASCtypeASC"><?php echo _("Record Year (oldest to newest), then Record Type (A to Z)"); ?></option>
                        <option value="yearDESCtypeASC"><?php echo _("Record Year (newest to oldest), then Record Type (A to Z)"); ?></option>
                    </select>
                    </label>
                </div>
            </div>
            
			<input id="submit" name="submit" type="submit" value="<?php echo _("Search"); ?>" class="button"/>
		</form>
        <div class="clear"></div>
        
        <div id="instructions">
            <h3><?php echo _("Notes about search"); ?></h3>
            <?php include('_includes/instructions.php'); ?>
            <div class="clear"></div>
        </div>
		<p><a href="#" title="instructions and notes" id="instructions-toggle">[<?php echo _("read instructions and notes"); ?>]</a></p>
	</div>
    <div class="triangle triangle-left"></div>
	<div class="triangle triangle-right"></div>
	<div class="clear"></div>

	<?php include('_includes/sidebar.php'); ?>

	<div id="main">

<?php  
	/* IF THE USER HAS NOT YET MADE A SEARCH, SHOW THE WELCOME MESSAGE INSTEAD OF THE RESULTS */ 
	if ( ($queryType=='') && ($querySurname=='') && ($queryGivenName=='') && ($queryTown=='') && ($queryLocation=='') && ($queryYear=='') && ($querySource=='') && ($queryRepository=='') ) { 
		include('_includes/welcome_message.php');
	 } else { 
?>

		<div class="navigation">
        	<?php include('_includes/navigation_buttons.php'); ?>
		</div>
		<div class="clear"></div>

        	
        <div id="results">

<?php
	foreach ($resultset AS $document) {
		
		include('_includes/results_definitions.php');
    	
		echo "<div class=\"result\">\n";
    	
		/* TEMPLATE: BIRTH */
		if (strpos($recordSource,'Birth')) {
			include('_includes/results_birth.php');
		}
		
		/* TEMPLATE: TAX */
		if (strpos($recordSource,'Tax')) {
			include('_includes/results_tax.php');
		}
		
		echo "	<div class=\"clear\"></div>\n";
		echo "	<div class=\"result-footer\">\n";
		echo "		<p>This record comes from the <em>".$recordSource."</em> database";
		//if ($recordArchive !== '') { echo ", archive <em>#".$recordArchive; };
		if ($recordFond !== '') { echo ", fond <em>".$recordFond."</em>"; };
		if ($recordSignature !== '') { echo ", signature <em>".$recordSignature."</em>"; };
		if ($recordCollection !== '') { echo ", collection <em>".$recordCollection."</em>"; };
		if ($recordRecordGroup !== '') { echo ", record group <em>".$recordRecordGroup."</em>"; };
		if ($recordBoxNumber !== '') { echo ", box number <em>".$recordBoxNumber."</em>"; };
		if ($recordYadVashemNumber !== '') { echo ", Yad Vashem number <em>".$recordYadVashemNumber."</em>"; };
		if ($recordFileNumber !== '') { echo ", file number <em>".$recordFileNumber."</em>"; };
		if ($recordBook !== '') { echo ", book <em>".$recordBook."</em>"; };
		if ($recordNumber !== '') { echo ", number <em>".$recordNumber."</em>"; };
		if ($recordBookAndNumber !== '') { echo ", book and number <em>".$recordBook."</em>"; };
		if ($recordPage !== '') { echo ", page <em>".$recordPage."</em>"; };
		if ($recordLine !== '') { echo ", line <em>".$recordLine."</em>"; };
		if ($recordItem !== '') { echo ", item <em>".$recordItem."</em>"; };
		if ($recordAKTNumber !== '') { echo ", AKT number <em>".$recordAKTNumber."</em>"; };
		//echo ".  The original records are held in <em>".$recordRepository."</em> and were added to this search engine on <em>".$recordAddition."</em>.  ";
		echo ".  The original records are held in <em>".$recordRepository."</em> and were added to this search engine on <em>";
		echo strftime("%e %B %Y", strtotime($recordAdditionDate));
		echo "</em>.  ";
		if ($recordLDSFilmNumber !== '') { 
			echo "An image of this record can also be viewed on LDS Microfilm <em>#".$recordLDSFilmNumber."</em>";
			if ($recordLDSFilmItemNumber !== '') { echo ", item <em>#".$recordLDSFilmItemNumber."</em>"; }
			echo ".  ";
		};
		echo "The unique record ID is <em>".$recordId."</em>.</p>\n";
		echo "	</div>\n";
    	echo "	<div class=\"clear\"></div>\n";
    	echo "</div>\n\n";
	}
?>

		</div>
		<div class="clear"></div>
	
		<div class="navigation navigation-bottom">
			<?php include('_includes/navigation_buttons.php'); ?>
		</div>
		<div class="clear"></div>

<?php } ?>
	
	</div>
	<div class="clear"></div>
	
</div>


<div class="screenreader">
	<form id="formHidden" name="formHidden" accept-charset="utf-8" method="post">
		<!-- <input type="hidden" name="start" value="<?php echo $start; ?>" /> -->
		<input type="hidden" name="querySurname" value="<?php $querySurname = str_replace("record_surnames:", "", $querySurname); echo $querySurname; ?>" />
		<input type="hidden" name="queryGivenName" value="<?php $queryGivenName = str_replace("record_givennames:", "", $queryGivenName); echo $queryGivenName; ?>" />
		<input type="hidden" name="queryTown" value="<?php $queryTown = str_replace("Town:", "", $queryTown); echo $queryTown; ?>" />
		<input type="hidden" name="queryLocation" value="<?php $queryLocation = str_replace("record_location:", "", $queryLocation); echo $queryLocation; ?>" />
		<input type="hidden" name="queryYear" value="<?php $queryYear = str_replace("record_years:", "", $queryYear); echo $queryYear; ?>" />
		<input type="hidden" name="queryType" value="<?php $queryType = str_replace("record_type:", "", $queryType); echo $queryType; ?>" />
		<input type="hidden" name="querySource" value="<?php $querySource = str_replace("record_source:", "", $querySource); echo $querySource; ?>" />
        <input type="hidden" name="queryRepository" value="<?php $queryRepository = str_replace("record_repository:", "", $queryRepository); echo $queryRepository; ?>" />
        <input type="hidden" name="querySort" value="<?php echo $querySort; ?>" />
        <input type="hidden" name="queryGeographicSortRange" value="<?php echo $queryGeographicSortRange; ?>" />
        <input type="hidden" name="queryGeographicSortTown" value="<?php echo $queryGeographicSortTown; ?>" />
	</form>
</div>


<?php include('_includes/footer.php'); ?>

<script type="text/javascript" charset="utf-8">
	$(function(){
		// THIS HANDLES CLICKS ON THE SIDEBAR FACETS
		function FacetHandler (idSuffix, queryMethod, inputName) {
    		$('#sidebar #filters ul#filters-' + idSuffix + ' li a').click (function (e) {
       	 		e.preventDefault();
        		var valQuery = $(this).data (queryMethod);
        		var inputHTML = '<input type="hidden" name="' + inputName + '" value="' + valQuery + '" />';
        		$('form#formHidden').append (inputHTML);
        		$('form#formHidden').submit( );
        		return false;
    		});
		}
		$(function () {
			// ul ID name suffix (<ul id="filters-foo">), then data type, then input name
    		FacetHandler ('surnames',    'surname',      'querySurname');
    		FacetHandler ('givennames',  'givenname',    'queryGivenName');
    		FacetHandler ('towns',       'town',         'queryTown');
    		FacetHandler ('locations',   'location',     'queryLocation');
    		FacetHandler ('years',       'year',         'queryYear');
    		FacetHandler ('types',       'recordtype',   'queryType');
    		FacetHandler ('sources',     'recordsource', 'querySource');
			FacetHandler ('repositories','repository',   'queryRepository');
		});
		
		// THIS HANDLES CLEARING THE SIDEBAR FACETS
		function ClearFacetHandler (classSuffix, inputName2) {
    		$('#sidebar #filters-current ul li.clear-' + classSuffix + ' a').click (function (e) {
       	 		e.preventDefault();
        		var inputHTML2 = '<input type="hidden" name="' + inputName2 + '" value="" />';
        		$('form#formHidden').append (inputHTML2);
        		$('form#formHidden').submit( );
        		return false;
    		});
		}
		$(function () {
    		ClearFacetHandler ('surname',      'querySurname');
    		ClearFacetHandler ('givenname',    'queryGivenName');
    		ClearFacetHandler ('town',         'queryTown');
    		ClearFacetHandler ('location',     'queryLocation');
    		ClearFacetHandler ('year',         'queryYear');
    		ClearFacetHandler ('recordtype',   'queryType');
    		ClearFacetHandler ('recordsource', 'querySource');
			ClearFacetHandler ('repository',   'queryRepository');
			ClearFacetHandler ('sort',   'querySort');
			ClearFacetHandler ('geographicsort',   'queryGeographicSortRange');
			ClearFacetHandler ('geographicsort',   'queryGeographicSortTown');
		});
	});
</script>

<?php /* If we're using New Relic (www.newrelic.com) to monitor the app, add the footer code now */ 
	if (function_exists('newrelic_get_browser_timing_footer')) { echo newrelic_get_browser_timing_footer(); }; ?>

</body>
</html>