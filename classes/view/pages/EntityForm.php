<?php if(!isset($user)){
		$user = new Entity;
		$action="create";}?>
<form action="./index.php?controller=registration&action=<?php echo $action?>" method="post">
<input type="hidden" name="user" value="Entity"/>
<?php
	include_once "forms/userForm.php";
	include_once "forms/legalPersonForm.php";
	include_once "forms/entityForm.php";
?>
<br/>
<input type="submit" value="Cadastrar"/>
</form>