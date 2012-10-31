<?php if(!isset($user)){} 
		$user = new VolunteerLegalPerson;
		$action="create";?>
<form action="./index.php?controller=registration&action=<?php echo $action?>" method="post">

<input type="hidden" name="user" value="LPVolunteer"/>
<?php
	include_once "forms/userForm.php";
	include_once "forms/legalPersonForm.php";
	include_once "forms/volunteerForm.php";
?>
<br/>
<input type="submit" value="Cadastrar"/>
</form>