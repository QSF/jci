<?php 

	require_once HELPER_PATH."/DisplayHelper.php";

	$arrayAttributes = array();

	include_once "profiles/userProfile.php";
	include_once "profiles/legalPersonProfile.php";
	include_once "profiles/volunteerProfile.php";

	displayAttribute($arrayAttributes);
?>