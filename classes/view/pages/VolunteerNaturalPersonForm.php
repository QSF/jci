<?php if(!isset($user)){
		$user = new VolunteerNaturalPerson;
		$action="create";}?>
<form action="./index.php?controller=registration&action=<?php echo $action?>" method="post">
<input type="hidden" name="user_id" value="<?php if(isset($user))echo $user->getId()?>"/>
<input type="hidden" name="user" value="NPVolunteer"/>
<?php
	include_once "forms/userForm.php";
	include_once "forms/naturalPersonForm.php";
	include_once "forms/volunteerForm.php";
?>
<br/>
<input type="submit" value="Cadastrar"/>
</form>