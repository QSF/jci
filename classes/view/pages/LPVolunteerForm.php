<form action=<?php echo PUBLIC_PATH?>/index.php?controller=registration&action=create>
<input type="hidden" value="LPVolunteer" name="userType"/>
<?php
	include_once "forms/userForm.php";
	include_once "forms/legalPersonForm.php";
	include_once "forms/volunteerForm.php";
?>
<br/>
<input type="submit" value="Cadastrar"/>
</form>