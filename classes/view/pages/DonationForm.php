<?php if(!isset($donation)){
		$donation = new Donation;
		$donation->setVolunteer(null);
		$donation->setEntity(null);
		$action="create";}?>

<form action="./index.php?controller=donation&action=<?php echo $action?>" method="post">

<?php require_once(VIEW_PATH . '/pages/forms/listUsers.php') ?>

<h4>Escolha um Voluntário:</h4>
<?php listUsers($volunteers,$donation->getVolunteer(),'id_voluntario'); ?>

<h4>Escolha uma Entidade:</h4>
<?php listUsers($entities,$donation->getEntity(),'id_entidade'); ?>

<h4>Escolha um Campo:</h4>
<?php require_once VIEW_PATH . "/pages/forms/listFields.php"; ?>

<label for="date">Data de fundação</label>
<input type="date" name="date" value="<?php $donation->getDate()->format('m/d/Y') ?>">

<label for="moreInfo">Mais infomações:</label>
<textarea class="input-block-level" cols="100" rows="5" name="moreInfo"><?php echo $donation->getMoreInfo()?></textarea>

<input type="hidden" name="id_donation" value="<?php echo $donation->getId();?>">

<input type="submit" class="btn" value="Realizar doação" >
</form>