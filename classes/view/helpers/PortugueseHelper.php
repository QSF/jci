<?php
	function returnStringType($type){
		$typePortuguese;
		switch($type){
			case "Entity":
				$typePortuguese = "Entidade";
				break;
			case "VolunteerLegalPerson":
				$typePortuguese = "Voluntário Pessoa Jurídica";
				break;
			case "VolunteerNaturalPerson":
				$typePortuguese = "Voluntário Pessoa Física";
				break;
			default:
				$typePortuguese = "Visitante";
				break;
		}
		return $typePortuguese;
	}
?>