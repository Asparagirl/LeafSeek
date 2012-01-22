
	<div id="sidebar">

<?php
	/* IF THE USER HAS NOT YET MADE A SEARCH, DON'T SHOW THE CURRENT FACETS/FILTERS  */
	if ( ($queryType !== '') || ($querySurname !== '') || ($queryGivenName !== '') || ($queryTown !== '') || ($queryLocation !== '') || ($queryYear !== '') || ($querySource !== '') || ($queryRepository !== '') ) { 
		include('_includes/sidebar_current_filters.php');
 	};
?>
		
		<div id="filters">
		
			<h2><?php echo _("Record Types"); ?></h2>
			<ul id="filters-types">
			<?php 
				$facet = $resultset->getFacetSet()->getFacet('FacetType');
				foreach($facet as $value => $count) {
					
					// THIS IS TO MAKE THE TRANSLATIONS OF THE NAMES OF THE VARIOUS RECORD TYPES WORK CORRECTLY
					$translatedValue = '';
					if ((ucwords($value)) == 'Birth') { $translatedValue = _("Birth"); }
					if ((ucwords($value)) == 'Burial') { $translatedValue = _("Burial"); }
					if ((ucwords($value)) == 'Census') { $translatedValue = _("Census"); }
					if ((ucwords($value)) == 'Charity') { $translatedValue = _("Charity"); }
					if ((ucwords($value)) == 'Criminal') { $translatedValue = _("Criminal"); }
					if ((ucwords($value)) == 'Death') { $translatedValue = _("Death"); }
					if ((ucwords($value)) == 'Deed') { $translatedValue = _("Deed"); }
					if ((ucwords($value)) == 'Divorce') { $translatedValue = _("Divorce"); }
					if ((ucwords($value)) == 'Emigration') { $translatedValue = _("Emigration"); }
					if ((ucwords($value)) == 'Holocaust') { $translatedValue = _("Holocaust"); }
					if ((ucwords($value)) == 'Landsmanschaften') { $translatedValue = _("Landsmanschaften"); }
					if ((ucwords($value)) == 'Immigration') { $translatedValue = _("Immigration"); }
					if ((ucwords($value)) == 'Marriage') { $translatedValue = _("Marriage"); }
					if ((ucwords($value)) == 'Military') { $translatedValue = _("Military"); }
					if ((ucwords($value)) == 'Newspaper') { $translatedValue = _("Newspaper"); }
					if ((ucwords($value)) == 'Organization') { $translatedValue = _("Organization"); }
					if ((ucwords($value)) == 'Permit') { $translatedValue = _("Permit"); }
					if ((ucwords($value)) == 'Phonebook') { $translatedValue = _("Phonebook"); }
					if ((ucwords($value)) == 'Pogrom') { $translatedValue = _("Pogrom"); }
					if ((ucwords($value)) == 'Political') { $translatedValue = _("Political"); }
					if ((ucwords($value)) == 'Property') { $translatedValue = _("Property"); }
					if ((ucwords($value)) == 'Religion') { $translatedValue = _("Religion"); }
					if ((ucwords($value)) == 'School') { $translatedValue = _("School"); }
					if ((ucwords($value)) == 'Tax') { $translatedValue = _("Tax"); }
					if ((ucwords($value)) == 'Union') { $translatedValue = _("Union"); }
					if ((ucwords($value)) == 'University') { $translatedValue = _("University"); }
					if ((ucwords($value)) == 'Voter') { $translatedValue = _("Voter"); }
					if ((ucwords($value)) == 'War') { $translatedValue = _("War"); }
					if ((ucwords($value)) == 'Will') { $translatedValue = _("Will"); }
					if ((ucwords($value)) == 'Yearbook') { $translatedValue = _("Yearbook"); }
					if ($translatedValue == '') { $translatedValue = ucwords($value); }
					
					echo '	<li><a href="#" data-recordtype="'.$value.'" title="';
					echo _("Add filter for Record Type");
					echo ': '.$translatedValue.'">'.$translatedValue.' <span class="facet-count">('.number_format($count).')</span></a></li>'."\n";
				}
			?>
			</ul>

<?php 
	/* IF THE USER HAS NOT YET MADE A SEARCH, DON'T SHOW MOST OF THE FACETS/FILTERS */
	if ( ($queryType=='') && ($querySurname=='') && ($queryGivenName=='') && ($queryTown=='') && ($queryLocation=='') && ($queryYear=='') && ($querySource=='') && ($queryRepository=='') ) { 
		// NOTHING
	} else { 
?>
			<h2><?php echo _("Top Surnames"); ?></h2>
			<ul id="filters-surnames">
			<?php 
				$facet = $resultset->getFacetSet()->getFacet('FacetSurname');
				foreach($facet as $value => $count) {
    				echo '	<li><a href="#" data-surname="'.$value.'" title="';
					echo _("Add filter for Surname");
					echo ': '.ucwords($value).'">'.ucwords($value).' <span class="facet-count">('.number_format($count).')</span></a></li>'."\n";
				}
			?>
			</ul>
		
			<h2><?php echo _("Top Given Names"); ?></h2>
			<ul id="filters-givennames">
			<?php 
				$facet = $resultset->getFacetSet()->getFacet('FacetGivenName');
				foreach($facet as $value => $count) {
    				echo '	<li><a href="#" data-givenname="'.$value.'" title="';
					echo _("Add filter for Given Name");
					echo ': '.ucwords($value).'">'.ucwords($value).' <span class="facet-count">('.number_format($count).')</span></a></li>'."\n";
				}
			?>
			</ul>
		
			<h2><?php echo _("Primary Locations"); ?></h2>
			<ul id="filters-towns" class="box">
			<?php 
				$facet = $resultset->getFacetSet()->getFacet('FacetTown');
				foreach($facet as $value => $count) {
					if ( ($value == '') || ($value == ' ') ) {
					// do nothing
					} else {
    					echo '	<li><a href="#" data-town="'.$value.'" title="';
						echo _("Add filter for Primary Location");
						echo ': '.ucwords($value).'">'.ucwords($value).' <span class="facet-count">('.number_format($count).')</span></a></li>'."\n";
					}
				}
			?>
			</ul>
			
			<h2><?php echo _("All Locations"); ?></h2>
            <ul id="filters-locations" class="box">
            <?php 
                $facet = $resultset->getFacetSet()->getFacet('FacetLocation');
                foreach($facet as $value => $count) {
					if ( ($value == '') || ($value == ' ') || ($value == '-') || ($value == ' -') || ($value == '- ') || ($value == ' - ') ) { 
						/* do nothing */ 
					} else {
                    	echo '	<li><a href="#" data-location="'.$value.'" title="';
						echo _("Add filter for All Locations");
						echo ': '.ucwords($value).'">'.ucwords($value).' <span class="facet-count">('.number_format($count).')</span></a></li>'."\n";
					}
                }
            ?>
            </ul>
		
			<h2><?php echo _("Years"); ?></h2>
            <ul id="filters-years" class="box">
            <?php 
                $facet = $resultset->getFacetSet()->getFacet('FacetYear');
                foreach($facet as $value => $count) {
					if ( ($value == '') || ($value == ' ') || ($value == '-') || ($value == 'circa') || ($value == 'early') || ($value == '18th') || ($value == '19th') || ($value == '20th') || ($value == 'century') || ($value == 'th') || ($value == 'thcentury') ) { 
						/* do nothing */ 
					} else {
                    	echo '	<li><a href="#" data-year="'.$value.'" title="';
						echo _("Add filter for Year");
						echo ': '.$value.'">'.$value.' <span class="facet-count">('.number_format($count).')</span></a></li>'."\n";
					}
                }
            ?>
            </ul>
<?php } ?>

			<h2><?php echo _("Record Sources"); ?></h2>
            <ul id="filters-sources" class="box">
            <?php 
                $facet = $resultset->getFacetSet()->getFacet('FacetSource');
                foreach($facet as $value => $count) {
                    echo '	<li><a href="#" data-recordsource="'.$value.'" title="';
					echo _("Add filter for Record Source");
					echo ': '.$value.'">'.$value.' <span class="facet-count">('.number_format($count).')</span></a></li>'."\n";
                }
            ?>
            </ul>
            
            <h2><?php echo _("Record Repositories"); ?></h2>
			<ul id="filters-repositories">
			<?php 
				$facet = $resultset->getFacetSet()->getFacet('FacetRepository');
				foreach($facet as $value => $count) {
    				echo '	<li><a href="#" data-repository="'.$value.'" title="';
					echo _("Add filter for Record Repository");
					echo ': '.$value.'">'.$value.' <span class="facet-count">('.number_format($count).')</span></a></li>'."\n";
				}
			?>
			</ul>
			
		</div>
		<div class="clear"></div>
	</div>
