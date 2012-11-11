<?php if(!isset($user)){
		$user = new Entity;
		$action="create";}?>

<?php if ($action == 'create')
		$buttonName="Cadastrar";
	  else if ($action == 'update')
	  	$buttonName="Editar";
?>

<form id="idUserForm" action="./index.php?controller=registration&action=<?php echo $action?>" method="post">
<fieldset>
    <legend>Cadastro de entidades</legend>
	<input type="hidden" name="user" value="Entity"/>
	<input type="hidden" name="user_id" value="<?php if(isset($user))echo $user->getId()?>"/>

	<?php
		include_once "forms/userForm.php";
		include_once "forms/legalPersonForm.php";
		include_once "forms/entityForm.php";
	?>
	<br/>
    <button type="submit" class="btn"><?php echo $buttonName; ?></button>
</fieldset>
</form>