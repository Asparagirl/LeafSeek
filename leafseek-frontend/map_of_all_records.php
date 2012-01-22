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
	$query->setRows(100);
	
	// get grouping component and set a field to group by
	$groupComponent = $query->getGrouping();
	$groupComponent->addField('record_source');
	$groupComponent->setLimit(1);
	$groupComponent->setNumberOfGroups(true);
	
	// OKAY, NOW MAKE THE QUERY!
	$resultset = $client->select($query);
	$groups = $resultset->getGrouping();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Map of All Records in the System // YOUR WEBSITE NAME HERE</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <?php /* If we're using New Relic (www.newrelic.com) to monitor the app, add the header code now */ if (function_exists('newrelic_get_browser_timing_header')) { echo newrelic_get_browser_timing_header(); }; ?>
    
    <meta name="description" content="YOUR DESCRIPTION HERE" />
	
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

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="_js/gmap3.min.js"></script>
    <script type="text/javascript">  
	$(function(){
        $('#locations-map').gmap3(
			{ action:'init',
				options:{
				  center:[49.5,23.5766],
				  zoom: 7
				}
			},
			{ action: 'addMarkers',
				markers:[
				<?php 
					foreach($groups AS $groupKey => $fieldGroup) {			
						//echo '<!-- '.$groupKey.' --> ';
						//echo '<!-- Matches: '.$fieldGroup->getMatches().' --> ';
						//echo '<!-- Number of groups: '.$fieldGroup->getNumberOfGroups().' --> ';
					
						foreach($fieldGroup AS $valueGroup) {
							//echo '<!-- '.$valueGroup->getValue().' --> ';
						
							foreach($valueGroup AS $document) {
								$recordSource = htmlspecialchars(($document->record_source), ENT_QUOTES);
								$recordLocation = htmlspecialchars(($document->record_location), ENT_QUOTES);
								$recordLatitude = $document->record_latitude;
								$recordLongitude = $document->record_longitude;
								if ( ($recordLatitude == '' ) || ($recordLongitude == '' ) ) {
									// don't show records that don't have a latitude or longitude
								} else {
									echo '				{lat:'.$recordLatitude.', lng:'.$recordLongitude.', data:';
									echo "'";
									echo '<strong>'.$recordSource.'</strong><br />'.$recordLocation;
									echo "'";
									echo '},';
									echo "\n";
								}
							}
						}
					}
				?>
				],
				marker:{
				  options:{
					draggable:false
				  },
				events:{
					mouseover: function(marker, event, data){
					  var map = $(this).gmap3('get'),
						  infowindow = $(this).gmap3({action:'get', name:'infowindow'});
					  if (infowindow){
						infowindow.open(map, marker);
						infowindow.setContent(data);
					  } else {
						$(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});
					  }
					},
					mouseout: function(){
					  var infowindow = $(this).gmap3({action:'get', name:'infowindow'});
					  if (infowindow){
						infowindow.close();
					  }
					}
				  }
				}
			}
		);
	});
    </script>
    
    <?php 
		// INCLUDE THIS FILE IF YOU ARE USING TYPEKIT FOR YOUR WEB FONTS
		// include('_includes/header_typekit.php'); 
	?>
	
</head>

<body id="about">

<div id="wrapper">
    
    <?php include('_includes/header.php'); ?>
    
    <?php include('_includes/news.php'); ?>
    
    <div id="search">
    	<h2>Map of all records in the database</h2>
        <div class="clear"></div>
    </div>
    <div class="triangle triangle-left"></div>
	<div class="triangle triangle-right"></div>
	<div class="clear"></div>

	<div id="main" class="no-sidebar">
        
        <h3 id="locations"><?php echo _("Towns and locations represented in this search engine"); ?></h3>
        
        <div id="locations-map"></div>
        
        <div class="clear"></div>

    </div>
    <div class="clear"></div>
	
</div>

<?php include('_includes/footer.php'); ?>

</body>
</html>