
<?php

		if ($recordGivenName == '') { 
			$recordGivenName = '<span class="result-emptyfield">[';
			$recordGivenName .= _("no given name");
			$recordGivenName .= ']</span>';
		};
		if ($recordSurname == '') {
			$recordSurname = '<span class="result-emptyfield">[';
			$recordSurname .= _("no surname");
			$recordSurname .= ']</span>';
		};
		
		$recordHasAParent = '';
		$recordHasASpouse = '';
		$recordHasAFather = '';
		$recordHasAMother = '';
		if ($recordFathersGivenName !== '') { $recordHasAParent = 'yes'; $recordHasAFather = 'yes'; $recordGender = _("child"); }
		if ($recordMothersGivenName !== '') { $recordHasAParent = 'yes'; $recordHasAMother = 'yes'; $recordGender = _("child"); }
		if ($recordSpousesGivenName !== '') { $recordHasASpouse = 'yes'; }

		echo "	<div class=\"result-header\">\n";
		echo "		<h3><span class=\"result-expand\"><span class=\"result-expand-plus\" title=\"";
		echo _("Click to expand this record");
		echo "\"></span></span>";
		if ($recordNamePrefix !== '') { echo $recordNamePrefix; echo " "; };
		echo $recordGivenName." ".$recordSurname;
		if ($recordNameSuffix !== '') { echo ", "; echo $recordNameSuffix; };
		if ($recordHasAParent == 'yes') {
			echo "<br />\n";
			echo "		<span class=\"result-parentage\">".$recordGender." ";
			echo _("of");
			echo " ";		
			echo $recordFathersGivenName;
			if (($recordHasAFather == 'yes') && ($recordHasAMother == 'yes')) { 
				echo " &amp; "; 
			}
			echo $recordMothersGivenName;
			echo "</span>";
		}
		if ($recordHasASpouse == 'yes') {
			echo "<br />\n";
			echo "		<span class=\"result-parentage\">";
			echo _("spouse");
			echo " ";
			echo _("of");
			echo " ";		
			echo $recordSpousesGivenName;
			echo "</span>";
		}
		echo "</h3>\n";
		echo "		<h4 title=\"".ucwords($recordType)." record\"><span class=\"result-type-".$recordType."\">".ucwords($recordType)." record</span></h4>\n";
		echo "		<h4 class=\"result-type-year\">".$recordYear."</h4>\n";
		echo "		<div class=\"clear\"></div>\n";
		echo "	</div>\n";
		echo "	<div class=\"clear\"></div>\n";
		echo "	<div class=\"result-body\">\n";
		echo "		<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
		echo "			<tr><th>";
		echo _("Year");
		echo ":</th><td>".$recordYear."</td></tr>\n";
		echo "			<tr><th>";
		echo _("Town");
		echo "</th><td>".$recordTown." (";
		echo _("now");
		echo " <a href=\"http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=".$recordLocation."\" title=\"Map of ".$recordLocation."\">".$recordLocation."</a>)</td></tr>\n";
		if ($recordResidenceTown !== '') {
			echo "		<tr><th>";
			echo _("Town of Residence");
			echo ":</th><td>".$recordResidenceTown."</td></tr>\n";
		}
		if ($recordComments !== '') {
			echo "		<tr><th>";
			echo _("Comments)");
			echo ":</th><td>".$recordComments."</td></tr>\n";
		}
		echo "		</table>\n";
		echo "	</div>\n";
?>
