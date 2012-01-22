<?php

		$recordId = $document->record_id;
		
		$recordSource = trim($document->record_source);
		$recordSource = htmlspecialchars($recordSource, ENT_QUOTES);
		$recordSource = str_replace("&#039;", "&#146;", $recordSource);
		
		$recordRepository = $document->record_repository;
		$recordAddition = $document->record_addition;
		$recordAdditionDate = $document->record_addition_date;
		// this one is actually an array:
		$recordType = $document->record_type;
		// this converts multivalue fields to a comma-separated string
        if(is_array($recordType)) $recordType = implode(', ', $recordType);
		
		// YEARS AND DATES
		$recordYear = trim($document->Year);
		$recordYearOfRegistration = trim($document->YearOfRegistration);
		$recordYearOfEvent = trim($document->YearOfEvent);
		$recordSchoolYear = trim($document->SchoolYear);
		$recordDateOfBirth = trim($document->DateOfBirth);
		$recordGroomsYearOfBirth = trim($document->GroomsYearOfBirth);
		$recordBridesYearOfBirth = trim($document->BridesYearOfBirth);
		$recordDateOfDeath = trim($document->DateOfDeath);
		$recordDateOfDivorce = trim($document->DateOfDivorce);
		$recordDateOfRegistration = trim($document->DateOfRegistration);
		$recordDateJoined = trim($document->DateJoined);
		$recordDateOfDocument = trim($document->DateOfDocument);
		
		// GIVEN NAMES
		$recordGivenName = trim($document->GivenName);
		$recordFathersGivenName = trim($document->FathersGivenName);
		$recordMothersGivenName = trim($document->MothersGivenName);
		$recordSpousesGivenName = trim($document->SpousesGivenName);
		$recordGroomsGivenName = trim($document->GroomsGivenName);
		$recordBridesGivenName = trim($document->BridesGivenName);
		$recordMothersFathersGivenName = trim($document->MothersFathersGivenName);
		$recordMothersMothersGivenName = trim($document->MothersMothersGivenName);
		$recordGroomsFathersGivenName = trim($document->GroomsFathersGivenName);
		$recordGroomsMothersGivenName = trim($document->GroomsMothersGivenName);
		$recordBridesFathersGivenName = trim($document->BridesFathersGivenName);
		$recordBridesMothersGivenName = trim($document->BridesMothersGivenName);
		$recordMemberGivenName = trim($document->MemberGivenName);
		$recordWifeGivenName = trim($document->WifeGivenName);
		$recordGuardian1GivenName = trim($document->Guardian1GivenName);
		$recordGuardian2GivenName = trim($document->Guardian2GivenName);
		$recordPaternalGrandfathersGivenName = trim($document->PaternalGrandfathersGivenName);
		$recordPaternalGrandmothersGivenName = trim($document->PaternalGrandmothersGivenName);
		$recordMaternalGrandfathersGivenName = trim($document->MaternalGrandfathersGivenName);
		$recordMaternalGrandmothersGivenName = trim($document->MaternalGrandmothersGivenName);
		$recordChild1GivenName = trim($document->Child1GivenName);
		$recordChild2GivenName = trim($document->Child2GivenName);
		
		// SURNAMES
		$recordSurname = trim($document->Surname);
		$recordMaidenName = trim($document->MaidenName);
		$recordFathersSurname = trim($document->FathersSurname);
		$recordMothersSurname = trim($document->MothersSurname);
		$recordMothersFathersSurname = trim($document->MothersFathersSurname);
		$recordMothersMothersSurname = trim($document->MothersMothersSurname);
		$recordSpousesSurname = trim($document->SpousesSurname);
		$recordGroomsSurname = trim($document->GroomsSurname);
		$recordBridesSurname = trim($document->BridesSurname);
		$recordGroomsFathersSurname = trim($document->GroomsFathersSurname);
		$recordGroomsMothersSurname = trim($document->GroomsMothersSurname);
		$recordBridesFathersSurname = trim($document->BridesFathersSurname);
		$recordBridesMothersSurname = trim($document->BridesMothersSurname);
		$recordMemberSurname = trim($document->MemberSurname);
		$recordWifeSurname = trim($document->WifeSurname);
		$recordGuardian1Surname = trim($document->Guardian1Surname);
		$recordGuardian2Surname = trim($document->Guardian2Surname);
		$recordPaternalGrandfathersSurname = trim($document->PaternalGrandfathersSurname);
		$recordPaternalGrandmothersSurname = trim($document->PaternalGrandmothersSurname);
		$recordMaternalGrandfathersSurname = trim($document->MaternalGrandfathersSurname);
		$recordMaternalGrandmothersSurname = trim($document->MaternalGrandmothersSurname);
		$recordOtherSurname = trim($document->OtherSurname);
		
		// TOWNS
		$recordTown = trim($document->Town);
		$recordResidenceTown = trim($document->ResidenceTown);
		$recordBirthTown = trim($document->BirthTown);
		$recordMarriageTown = trim($document->MarriageTown);
		$recordDeceasedTown = trim($document->DeceasedTown);
		$recordFathersTown = trim($document->FathersTown);
		$recordMothersTown = trim($document->MothersTown);
		$recordFathersParentsTown = trim($document->FathersParentsTown);
		$recordMothersParentsTown = trim($document->MothersParentsTown);
		$recordPaternalGrandparentsTown = trim($document->PaternalGrandparentsTown);
		$recordMaternalGrandparentsTown = trim($document->MaternalGrandparentsTown);
		$recordBridesTown = trim($document->BridesTown);
		$recordGroomsTown = trim($document->GroomsTown);
		$recordMemberBirthplace = trim($document->MemberBirthplace);
		$recordWifeBirthplace = trim($document->WifeBirthplace);
		$recordOtherTown = trim($document->OtherTown);
		$recordLandsmanschaftenSocietyLocation = trim($document->LandsmanschaftenSocietyLocation);
		
		// NON-TOWN LOCATIONAL AND PROPERTY STUFF
		$recordHouseNumber = trim($document->HouseNumber);
		$recordStreetAddress = trim($document->StreetAddress);
		$recordAddressHome = trim($document->AddressHome);
		$recordAddressWork = trim($document->AddressWork);
		$recordAddressBirth = trim($document->AddressBirth);
		$recordNumberOnMap = trim($document->NumberonMap);
		$recordArea = trim($document->Area);
		$recordDistrict = trim($document->District);
		$recordProvince = trim($document->Province);
		$recordSection = trim($document->Section);
		$recordLandTenure = trim($document->LandTenure);
		$recordPropertyArea = trim($document->PropertyArea);
		$recordPropertyAreaMorgi = trim($document->PropertyAreaMorgi);
		$recordPropertyAreaSazni = trim($document->PropertyAreaSazni);	
		$recordLocation = trim($document->record_location);
		$recordLocation = htmlspecialchars($recordLocation, ENT_QUOTES);
		$recordLocation = str_replace("&#039;", "&#146;", $recordLocation);
		
		// CONVERT ANY FRACTIONS TO HTML ENTITIES
		$recordAge = trim($document->Age);
		$recordAge = htmlentities($recordAge, ENT_QUOTES, "UTF-8");
		$recordMemberAge = trim($document->MemberAge);
		$recordMemberAge = htmlentities($recordMemberAge, ENT_QUOTES, "UTF-8");
		$recordWifeAge = trim($document->WifeAge);
		$recordWifeAge = htmlentities($recordWifeAge, ENT_QUOTES, "UTF-8");
		$recordGroomsAge = trim($document->GroomsAge);
		$recordGroomsAge = htmlentities($recordGroomsAge, ENT_QUOTES, "UTF-8");
		$recordBridesAge = trim($document->BridesAge);
		$recordBridesAge = htmlentities($recordBridesAge, ENT_QUOTES, "UTF-8");
		$recordChild1Age = trim($document->Child1Age);
		$recordChild1Age = htmlentities($recordChild1Age, ENT_QUOTES, "UTF-8");
		$recordChild2Age = trim($document->Child2Age);
		$recordChild2Age = htmlentities($recordChild2Age, ENT_QUOTES, "UTF-8");
		
		// NOTES AND COMMENTS
		$recordNotes = trim($document->Notes);
		$recordNotesPolish = trim($document->NotesPolish);
		$recordNotesEnglish = trim($document->NotesEnglish);
		$recordComments = trim($document->Comments);
		$recordGroomsComments = trim($document->GroomsComments);
		$recordBridesComments = trim($document->BridesComments);
		
		// FINDING AIDS
		$recordLDSFilmNumber = trim($document->LDSFilmNumber);
		$recordLDSFilmItemNumber = trim($document->LDSFilmItemNumber);
		$recordPage = trim($document->Page);
		$recordAKTNumber = trim($document->AKTNumber);
		$recordBook = trim($document->Book);
		$recordNumber = trim($document->Number);
		$recordBookAndNumber = trim($document->BookAndNumber);
		$recordLine = trim($document->Line);
		$recordItem = trim($document->Item);
		$recordCollection = trim($document->Collection);
		$recordArchive = trim($document->Archive);
		$recordFond = trim($document->Fond);
		$recordSignature = trim($document->Signature);
		$recordRecordGroup = trim($document->RecordGroup);
		$recordBoxNumber = trim($document->BoxNumber);
		$recordFileNumber = trim($document->FileNumber);
		$recordYadVashemNumber = trim($document->YadVashemNumber);
		
		// LANDSMANSCHAFTEN STUFF
		$recordLandsmanschaftenSocietyName = trim($document->LandsmanschaftenSocietyName);
		$recordNumberOfChildren = trim($document->NumberOfChildren);
		$recordBuriedInNadwornaPlot = trim($document->BuriedInNadwornaPlot);
		$recordBuriedInStanislawowPlot = trim($document->BuriedInStanislawowPlot);
		
		// MISCELLANEOUS
		$recordOccupationPolish = trim($document->OccupationPolish);
		$recordOccupationEnglish = trim($document->OccupationEnglish);
		$recordFathersOccupationPolish = trim($document->OccupationFathersPolish);
		$recordFathersOccupationEnglish = trim($document->OccupationFathersEnglish);
		$recordTelephoneNumber = trim($document->TelephoneNumber);
		$recordSchoolName = trim($document->SchoolName);
		$recordReligion = trim($document->Religion);
		$recordFamilyStatus = trim($document->FamilyStatus);
		$recordCongregationalFamilyNumber = trim($document->CongregationalFamilyNumber);
		$recordBridesCongregationalFamilyNumber = trim($document->BridesCongregationalFamilyNumber);
		$recordGroomsCongregationalFamilyNumber = trim($document->GroomsCongregationalFamilyNumber);
		$recordSex = trim($document->Sex);
		$recordSchoolGradeOrClass = trim($document->SchoolGradeOrClass);
		$recordPhotograph = trim($document->Photograph);
		$recordOriginal = trim($document->Original);
		$recordDocumentLanguage = trim($document->DocumentLanguage);
		$recordFileNotation = trim($document->FileNotation);
		$recordCauseOfDeath = trim($document->CauseOfDeath);
		$recordNamePrefix = trim($document->NamePrefix);
		$recordNameSuffix = trim($document->NameSuffix);

?>
