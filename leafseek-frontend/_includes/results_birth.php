
<?php

		if ( ($recordGivenName == '') || ($recordGivenName == 'Nescio') || ($recordGivenName == 'nescio') || ($recordGivenName == 'N [Nescio=not known]') || ($recordGivenName == 'N. [Nescio=not known]') || ($recordGivenName == 'N[Nescio=not known]') || ($recordGivenName == 'N.[Nescio=not known]') || ($recordGivenName == 'N [Nescio=unknown]') || ($recordGivenName == 'N. [Nescio=unknown]') || ($recordGivenName == 'N[Nescio=unknown]') || ($recordGivenName == 'N.[Nescio=unknown]')) { 
			$recordGivenName = '<span class="result-emptyfield">[';
			$recordGivenName .= _("no given name");
			$recordGivenName .=  ']</span>';
		};
		if ($recordSurname == '') { 
			$recordSurname = '<span class="result-emptyfield">[';
			$recordSurname .= _("no surname");
			$recordSurname .= ']</span>';
		};
		
		$recordFathersName = ''; if ( ($recordFathersGivenName == '') && ($recordFathersSurname == '') ) { $recordFathersName = 'no'; } else { $recordFathersName = 'yes'; };
		$recordMothersName = ''; if ( ($recordMothersGivenName == '') && ($recordMothersSurname == '') ) { $recordMothersName = 'no'; } else { $recordMothersName = 'yes'; };	
		
		$recordHasAParent = ''; if ( ($recordFathersName == 'yes') || ($recordMothersName == 'yes') ) { $recordHasAParent = 'yes'; } else {$recordHasAParent = 'no'; };
		
		if ($recordFathersName == 'no') { 
			$recordFathersName = '<span class="result-emptyfield">[';
			$recordFathersName .= _("father's name not recorded");
			$recordFathersName .= ']</span>';
		};
		if ($recordMothersName == 'no') { 
			$recordMothersName = '<span class="result-emptyfield">[';
			$recordMothersName .= _("mother's name not recorded");
			$recordMothersName .= ']</span>';
		};
		
		if ( ($recordFathersGivenName == '') || ($recordFathersGivenName == 'nescio') || ($recordFathersGivenName == 'N [Nescio=not known]') || ($recordFathersGivenName == 'N. [Nescio=not known]') || ($recordFathersGivenName == 'N [Nescio=unknown]') || ($recordFathersGivenName == 'N. [Nescio=unknown]') ) { 
			$recordFathersGivenName = '<span class="result-emptyfield">[';
			$recordFathersGivenName .= _("no given name");
			$recordFathersGivenName .= ']</span>'; 
		};
		if ( ($recordMothersGivenName == '') || ($recordMothersGivenName == 'nescio') || ($recordFathersGivenName == 'N [Nescio=not known]') || ($recordMothersGivenName == 'N. [Nescio=not known]') || ($recordMothersGivenName == 'N [Nescio=unknown]') || ($recordMothersGivenName == 'N. [Nescio=unknown]') ) { 
			$recordMothersGivenName = '<span class="result-emptyfield">[';
			$recordMothersGivenName .= _("no given name");
			$recordMothersGivenName .= ']</span>';
		};
		
		$recordGender = '';
		if ( ($recordSex == 'M') || ($recordSex == '[M]') ) { 
			$recordGender = _("son");
		} else if ( ($recordSex == 'F') || ($recordSex == '[F]') ) { 
			$recordGender = _("daughter");
		} else { 
			$recordGender = _("child");
		};

		echo "	<div class=\"result-header\">\n";
		echo "		<h3><span class=\"result-expand\"><span class=\"result-expand-plus\" title=\"";
		echo _("Click to expand this record");
		echo "\"></span></span>".$recordGivenName." ".$recordSurname;
		if ($recordHasAParent == 'yes') {
			echo "<br />\n";
			echo "		<span class=\"result-parentage\">".$recordGender." ";
			echo _("of");
			echo " ";		
			if ($recordFathersName == 'yes') { 
				echo $recordFathersGivenName." ".$recordFathersSurname; 
			//} else {
			//	echo $recordFathersName;
			}
			if (($recordFathersName == 'yes') && ($recordMothersName == 'yes')) { 
				echo " &amp; "; 
			}
			if ($recordMothersName == 'yes') { 
				echo $recordMothersGivenName." ".$recordMothersSurname; 
			//} else {
			//	echo $recordMothersName;
			}
			echo "</span>";
		}
		echo "</h3>\n";
		echo "		<h4 title=\"".ucwords($recordType)." record\"><span class=\"result-type-".$recordType."\">".ucwords($recordType)." record</span></h4>\n";
		
		if ( ($recordYearOfEvent !== '') && ($recordYearOfEvent !== '[unknown]') && ($recordYearOfEvent !== 'unknown') ) {
			echo "	<h4 class=\"result-type-year\">".$recordYearOfEvent."</h4>\n";
		} else if ( ($recordYear == '') && ($recordYearOfEvent == '') && ($recordDateOfBirth !== '') ) {
			$recordYearOfBirth = substr($recordDateOfBirth, -4);
			echo "	<h4 class=\"result-type-year\">".$recordYearOfBirth."</h4>\n";
		} else {
			echo "	<h4 class=\"result-type-year\">".$recordYear."</h4>\n";
		}
		
		echo "		<div class=\"clear\"></div>\n";
		echo "	</div>\n";
		echo "	<div class=\"clear\"></div>\n";
		echo "	<div class=\"result-body\">\n";
		echo "		<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
		if ($recordYearOfEvent !== '') {
			echo "		<tr><th>";
			echo _("Year of Birth");
			echo ":</th><td>".$recordYearOfEvent."</td></tr>\n";
		}
		if ($recordDateOfBirth !== '') {
			echo "		<tr><th>";
			echo _("Date of Birth");
			echo ":</th><td>".$recordDateOfBirth."</td></tr>\n";
		}
		if ($recordYearOfRegistration !== '') {
			echo "		<tr><th>";
			echo _("Year of Registration of Birth");
			echo ":</th><td>".$recordYearOfRegistration."</td></tr>\n";
		}
		if ($recordSex !== '') {
			echo "		<tr><th>";
			echo _("Sex");
			echo ":</th><td>".$recordSex."</td></tr>\n";
		}
		if ($recordAge !== '') {
			echo "		<tr><th>";
			echo _("Age");
			echo ":</th><td>".$recordAge."</td></tr>\n";
		}
		echo "			<tr><th>";
		echo _("Town");
		echo "</th><td>".$recordTown." (";
		echo _("now");
		echo " <a href=\"http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=".$recordLocation."\" title=\"Map of ".$recordLocation."\">".$recordLocation."</a>)</td></tr>\n";
		if ($recordBirthTown !== '') {
			echo "			<tr><th>";
			echo _("Town of Birth");
			echo ":</th><td>".$recordBirthTown."</td></tr>\n";
		}
		if ($recordHouseNumber !== '') {
			echo "		<tr><th>";
			echo _("House Number");
			echo ":</th><td>".$recordHouseNumber;
			echo"</td></tr>\n";
		}
		if ($recordCongregationalFamilyNumber !== '') {
			echo "		<tr><th>";
			echo _("Congregational Family Number");
			echo ":</th><td>".$recordCongregationalFamilyNumber."</td></tr>\n";
		}
		if ($recordFathersTown !== '') {
			echo "		<tr><th>";
			echo _("Father's Town");
			echo ":</th><td>".$recordFathersTown."</td></tr>\n";
		}
		if ($recordMothersTown !== '') {
			echo "		<tr><th>";
			echo _("Mother's Town");
			echo ":</th><td>".$recordMothersTown."</td></tr>\n";
		}
		if ($recordMothersFathersGivenName !== '') {
			echo "		<tr><th>";
			echo _("Mother's Father's Given Name");
			echo ":</th><td>".$recordMothersFathersGivenName."</td></tr>\n";
		}
		if ($recordMaternalGrandfathersGivenName !== '') {
			echo "		<tr><th>";
			echo _("Maternal Grandfather's Given Name");
			echo ":</th><td>".$recordMaternalGrandfathersGivenName."</td></tr>\n";
		}
		if ($recordMothersFathersSurname !== '') {
			echo "		<tr><th>";
			echo _("Mother's Father's Surname");
			echo ":</th><td>".$recordMothersFathersSurname."</td></tr>\n";
		}
		if ($recordMaternalGrandfathersSurname !== '') {
			echo "		<tr><th>";
			echo _("Maternal Grandfather's Surname");
			echo ":</th><td>".$recordMaternalGrandfathersSurname."</td></tr>\n";
		}
		if ($recordMothersMothersGivenName !== '') {
			echo "		<tr><th>";
			echo _("Mother's Mother's Given Name");
			echo ":</th><td>".$recordMothersMothersGivenName."</td></tr>\n";
		}
		if ($recordMaternalGrandmothersGivenName !== '') {
			echo "		<tr><th>";
			echo _("Maternal Grandmother's Given Name");
			echo ":</th><td>".$recordMaternalGrandmothersGivenName."</td></tr>\n";
		}
		if ($recordMothersMothersSurname !== '') {
			echo "		<tr><th>";
			echo _("Mother's Mother's Surname");
			echo ":</th><td>".$recordMothersMothersSurname."</td></tr>\n";
		}
		if ($recordMaternalGrandmothersSurname !== '') {
			echo "		<tr><th>";
			echo _("Maternal Grandmother's Surname");
			echo ":</th><td>".$recordMaternalGrandmothersSurname."</td></tr>\n";
		}
		if ($recordMothersParentsTown !== '') {
			echo "		<tr><th>";
			echo _("Mother's Parents' Town");
			echo ":</th><td>".$recordMothersParentsTown."</td></tr>\n";
		}
		if ($recordMaternalGrandparentsTown !== '') {
			echo "		<tr><th>";
			echo _("Maternal Grandparents' Town");
			echo ":</th><td>".$recordMaternalGrandparentsTown."</td></tr>\n";
		}
		if ($recordPaternalGrandparentsTown !== '') {
			echo "		<tr><th>";
			echo _("Paternal Grandparents' Town");
			echo ":</th><td>".$recordPaternalGrandparentsTown."</td></tr>\n";
		}
		if ($recordOtherTown !== '') {
			echo "		<tr><th>";
			echo _("Other Town(s)");
			echo ":</th><td>".$recordOtherTown."</td></tr>\n";
		}
		if ($recordFathersOccupationPolish !== '') {
			echo "		<tr><th>";
			echo _("Father's Occupation (original Polish)");
			echo ":</th><td>".$recordFathersOccupationPolish."</td></tr>\n";
		}
		if ($recordFathersOccupationEnglish !== '') {
			echo "		<tr><th>";
			echo _("Father's Occupation (English translation)");
			echo ":</th><td>".$recordFathersOccupationEnglish."</td></tr>\n";
		}
		if ($recordComments !== '') {
			echo "		<tr><th>";
			echo _("Comments");
			echo ":</th><td>".$recordComments."</td></tr>\n";
		}
		if ($recordNotes !== '') {
			echo "		<tr><th>";
			echo _("Notes");
			echo ":</th><td>".$recordNotes."</td></tr>\n";
		}		
		echo "		</table>\n";
		echo "	</div>\n";
?>
