<?php if(!isset($user)){
		$user = new VolunteerLegalPerson;
		$action="create";}?>

<form id="idUserForm" action="./index.php?controller=registration&action=<?php echo $action?>" method="post">
  <fieldset>
    <legend>Cadastro de empresas voluntárias</legend>
    <input type="hidden" name="user_id" value="<?php if(isset($user))echo $user->getId()?>"/>
    <input type="hidden" name="user" value="VolunteerLegalPerson"/>
    <?php
	  include_once "forms/userForm.php";
	  include_once "forms/legalPersonForm.php";
	  include_once "forms/volunteerForm.php";
    ?>
    <button type="submit" class="btn">Cadastrar</button>
  </fieldset>
</form>