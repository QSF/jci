<form action="./index.php?controller=registration&action=create" method="post">
<input type="hidden" name="user" value="NPVolunteer"/>
<?php
	include_once "forms/userForm.php";
	include_once "forms/naturalPersonForm.php";
	include_once "forms/volunteerForm.php";
?>
<br/>
<input type="submit" value="Cadastrar"/>
</form>