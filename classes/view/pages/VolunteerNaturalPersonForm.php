<?php if(!isset($user)){
		$user = new VolunteerNaturalPerson;
		$action="create";}?>
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
	<br/>
	<button type="submit" class="btn">Cadastrar</button>
</fieldset>
</form>