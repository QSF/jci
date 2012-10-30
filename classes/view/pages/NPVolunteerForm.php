<form action=<?php echo PUBLIC_PATH?>/index.php?controller=registration&action=create>
<input type="hidden" value="NPVolunteer" name="userType"/>
<?php
	include_once "forms/userForm.php";
	include_once "forms/naturalPersonForm.php";
	include_once "forms/volunteerForm.php";
?>
<br/>
<input type="submit" value="Cadastrar"/>
</form>