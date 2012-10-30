<form action="./index.php?controller=registration&action=create" method="post">
<input type="hidden" name="user" value="Entity"/>
<?php
	include_once "forms/userForm.php";
	include_once "forms/legalPersonForm.php";
	include_once "forms/entityForm.php";
?>
<br/>
<input type="submit" value="Cadastrar"/>
</form>