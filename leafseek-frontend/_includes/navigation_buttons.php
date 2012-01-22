
			<p>
			<?php 
				echo _("Results found");
				echo ': '. number_format($resultset->getNumFound()) .' (';
				echo _("showing");
				echo ' '. number_format($start+1) .' ';
				echo _("to");
				echo ' ';
				if ( ($start+$query->getRows()) > ($resultset->getNumFound()) ) {
					echo number_format($resultset->getNumFound());
				} else {
					echo number_format($start+$query->getRows());
				};
				echo ')';
			?>
			</p> 
			<div class="navigation-buttons">
<?php
	// NEXT BUTTON
	if ( ($resultset->getNumFound()) > ($start+$query->getRows()) ) {
		echo '<form accept-charset="utf-8" method="post">'."\n";
		echo '	<input type="hidden" name="start" value="';
		echo ($start+$query->getRows());
		echo '"/>'."\n";
		echo '	<input type="hidden" name="querySurname" value="'. $querySurname .'" />'."\n";
		echo '	<input type="hidden" name="queryGivenName" value="'. $queryGivenName .'" />'."\n";
		echo '	<input type="hidden" name="queryTown" value="'. $queryTown .'" />'."\n";
		echo '	<input type="hidden" name="queryLocation" value="'. $queryLocation .'" />'."\n";
		echo '	<input type="hidden" name="queryYear" value="'. $queryYear .'" />'."\n";
		echo '	<input type="hidden" name="queryType" value="'. $queryType .'" />'."\n";
		echo '	<input type="hidden" name="querySource" value="'. $querySource .'" />'."\n";
		echo '	<input type="hidden" name="queryRepository" value="'. $queryRepository .'" />'."\n";
		echo '	<input type="hidden" name="querySort" value="'. $querySort .'" />'."\n";
		echo '	<input type="hidden" name="queryGeographicSortRange" value="'. $queryGeographicSortRange .'" />'."\n";
		echo '	<input type="hidden" name="queryGeographicSortTown" value="'. $queryGeographicSortTown .'" />'."\n";
		echo '	<input name="navigation-next" value="';
		echo _("next 40 results");
		echo ' &raquo;" type="submit" class="button"/>'."\n";
		echo '</form>'."\n";
	}
	// PREVIOUS BUTTON
	if ($start !== 0) {
		echo '<form accept-charset="utf-8" method="post">'."\n";
		echo '	<input type="hidden" name="start" value="';
		echo ($start-$query->getRows());
		echo '"/>'."\n";
		echo '	<input type="hidden" name="querySurname" value="'. $querySurname .'" />'."\n";
		echo '	<input type="hidden" name="queryGivenName" value="'. $queryGivenName .'" />'."\n";
		echo '	<input type="hidden" name="queryTown" value="'. $queryTown .'" />'."\n";
		echo '	<input type="hidden" name="queryLocation" value="'. $queryLocation .'" />'."\n";
		echo '	<input type="hidden" name="queryYear" value="'. $queryYear .'" />'."\n";
		echo '	<input type="hidden" name="queryType" value="'. $queryType .'" />'."\n";
		echo '	<input type="hidden" name="querySource" value="'. $querySource .'" />'."\n";
		echo '	<input type="hidden" name="queryRepository" value="'. $queryRepository .'" />'."\n";
		echo '	<input type="hidden" name="querySort" value="'. $querySort .'" />'."\n";
		echo '	<input type="hidden" name="queryGeographicSortRange" value="'. $queryGeographicSortRange .'" />'."\n";
		echo '	<input type="hidden" name="queryGeographicSortTown" value="'. $queryGeographicSortTown .'" />'."\n";
		echo '	<input name="navigation-previous" value="&laquo; ';
		echo _("previous 40 results");
		echo '" type="submit" class="button"/>'."\n";
		echo '</form>'."\n";
	}
?>
			</div>
			<div class="clear"></div>
