<?php if(!isset($donation)){
		$donation = new Donation;
		$action="create";}?>

<form action="./index.php?controller=donation&action=<?php echo $action?>" method="post">

<?php require_once(VIEW_PATH . '/pages/form/listUsers.php') ?>

<?php listUsers($volunteers,$donation->getVolunteer(),'id_voluntario'); ?>

<?php listUsers($entities,$donation->getEntity(),'id_entidade'); ?>

<?php require_once VIEW_PATH . "/pages/forms/listFields.php"; ?>

<label for="date">Data de fundação</label>
<input type="text" value="<?php if(isset($donation->getDate()) ) echo $donation->getDate()->format('d/m/Y') ?>" 
	id="idStablishmentDate" name="date"/>
	
<input type="submit" value="Realizar doação"/>
</form>