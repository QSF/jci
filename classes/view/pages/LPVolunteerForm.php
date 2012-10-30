<form action="./index.php?controller=registration&action=create" method="post">
<input type="hidden" value="LPVolunteer" name="userType"/>
<?php
	include_once "forms/userForm.php";
	include_once "forms/legalPersonForm.php";
	include_once "forms/volunteerForm.php";
?>
<br/>
<input type="submit" value="Cadastrar"/>
</form>