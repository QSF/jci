<?php if(!isset($user)){
		$user = new VolunteerNaturalPerson;
		$action="create";}?>

<?php if ($action == 'create')
		$buttonName="Cadastrar";
	  else if ($action == 'update')
	  	$buttonName="Editar";
?>

<form id="idUserForm" action="./index.php?controller=registration&action=<?php echo $action?>" method="post">
<fieldset>
    <legend>Cadastro de voluntário</legend>
	<input type="hidden" name="user_id" value="<?php if(isset($user))echo $user->getId()?>"/>
	<input type="hidden" name="user" value="VolunteerNaturalPerson"/>
	<?php
		include_once "forms/userForm.php";
		include_once "forms/naturalPersonForm.php";
		include_once "forms/volunteerForm.php";
	?>
	<button type="submit" class="btn"><?php echo $buttonName; ?></button>
</fieldset>
</form>