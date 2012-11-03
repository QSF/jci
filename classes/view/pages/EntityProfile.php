<?php 
	require_once HELPER_PATH."/DisplayHelper.php";

	$arrayAttribute = array();

	include_once "profiles/userProfile.php";
	include_once "profiles/legalPersonProfile.php";
	include_once "profiles/entityProfile.php";

	displayAttribute($arrayAttribute);
?>