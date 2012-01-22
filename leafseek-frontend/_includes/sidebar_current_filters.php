
		<div id="filters-current">
			<h2><?php echo _("Record Sources"); ?></h2>
			<ul>
				<?php
					if ($queryType !== '') { 
						$queryType = ucwords(str_replace("record_type:", "", $queryType)); 
						echo '<li class="clear-recordtype"><a href="#" title="';
						echo _("Remove the filter for Record Type");
						echo ': '.$queryType.'"><span class="remove">&#10008; </span><span class="querytype">';
						echo _("Record Type");
						echo ':</span> '.$queryType.'</a></li>'."\n";
					}
					if ($querySurname !== '') { 
						$querySurname = ucwords(str_replace("record_surnames:", "", $querySurname)); 
						echo '<li class="clear-surname"><a href="#" title="';
						echo _("Remove the filter for Surname");
						echo ': '.$querySurname.' "><span class="remove">&#10008; </span><span class="querytype">';
						echo _("Surname");
						echo ':</span> '.$querySurname.'</a></li>'."\n";
					}
					if ($queryGivenName !== '') { 
						$queryGivenName = ucwords(str_replace("record_givennames:", "", $queryGivenName)); 
						echo '<li class="clear-givenname"><a href="#" title="';
						echo _("Remove the filter for Given Name");
						echo ': '.$queryGivenName.'"><span class="remove">&#10008; </span><span class="querytype">';
						echo _("Given Name");
						echo ':</span> '.$queryGivenName.'</a></li>'."\n";
					}
					if ($queryTown !== '') { 
						$queryTown = ucwords(str_replace("Town:", "", $queryTown)); 
						echo '<li class="clear-town"><a href="#" title="';
						echo _("Remove the filter for Primary Location");
						echo ': '.$queryTown.'"><span class="remove">&#10008; </span><span class="querytype">';
						echo _("Primary Location");
						echo ':</span> '.$queryTown.'</a></li>'."\n";
					}
					if ($queryLocation !== '') { 
						$queryLocation = ucwords(str_replace("record_location:", "", $queryLocation)); 
						echo '<li class="clear-location"><a href="#" title="';
						echo _("Remove the filter for All Locations");
						echo ': '.$queryLocation.'"><span class="remove">&#10008; </span><span class="querytype">';
						echo _("All Locations");
						echo ':</span> '.$queryLocation.'</a></li>'."\n";
					}
					if ($queryYear !== '') { 
						$queryYear = ucwords(str_replace("record_years:", "", $queryYear)); 
						echo '<li class="clear-year"><a href="#" title="';
						echo _("Remove the filter for Year");
						echo ': '.$queryYear.'"><span class="remove">&#10008; </span><span class="querytype">';
						echo _("Year");
						echo ':</span> '.$queryYear.'</a></li>'."\n";
					}
					if ($querySource !== '') { 
						// don't change capitalization for record source
						$querySource = str_replace("record_source:", "", $querySource); 
						echo '<li class="clear-recordsource"><a href="#" title="';
						echo _("Remove the filter for Record Source");
						echo ': '.$querySource.'"><span class="remove">&#10008; </span><span class="querytype">';
						echo _("Record Source");
						echo ':</span> '.$querySource.'</a></li>'."\n";
					}
					if ($queryRepository !== '') { 
						// don't change capitalization for record repository
						$queryRepository = str_replace("record_repository:", "", $queryRepository); 
						echo '<li class="clear-repository"><a href="#" title="';
						echo _("Remove the filter for Record Repository");
						echo ': '.$queryRepository.'"><span class="remove">&#10008; </span><span class="querytype">';
						echo _("Record Repository");
						echo ':</span> '.$queryRepository.'</a></li>'."\n";
					}
					if ( ($queryGeographicSortRange !== '') && ($queryGeographicSortTown !== '') ) { 
						$queryGeographicSortText = 'Within '.$queryGeographicSortRange.' kilometers of '.$queryGeographicSortTown;
						echo '<li class="clear-geographicsort"><a href="#" title="';
						echo _("Remove the filter for Geographic Limits");
						echo ': '.$queryGeographicSortText.'"><span class="remove">&#10008; </span><span class="querytype">';
						echo _("Geographic Limits");
						echo ':</span> '.$queryGeographicSortText.'</a></li>'."\n";
					}
					if ($querySort !== '') { 
						if ($querySort == 'typeASCyearASC') { $querySort = 'Record Type (A to Z), then Record Year (oldest to newest)'; };
						if ($querySort == 'typeDESCyearASC') { $querySort = 'Record Type (Z to A), then Record Year (oldest to newest)'; };
						if ($querySort == 'yearASCtypeASC') { $querySort = 'Record Year (oldest to newest), then Record Type (A to Z)'; };
						if ($querySort == 'yearDESCtypeASC') { $querySort = 'Record Year (newest to oldest), then Record Type (A to Z)'; };
						echo '<li class="clear-sort"><a href="#" title="';
						echo _("Remove the filter for Record Sort");
						echo ': '.$querySort.'"><span class="remove">&#10008; </span><span class="querytype">';
						echo _("Sort by");
						echo ':</span> '.$querySort.'</a></li>'."\n";
					}
				?>
			</ul>
		</div>
