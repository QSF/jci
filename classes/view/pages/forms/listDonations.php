<?php 
function listDonations($donations,$isModerador){	?>
	<ul>
	<?php 
		$hasDonation = false; //para colocar a linha no final.
		foreach ($donations as $var){?>
			<hr>
			<li>
			<?php echo $var->getDate()->format('d/m/Y'); ?>
			<?php if ($isModerador) { //é página de Moderador?>
				<a href="./index.php?controller=donation&action=redirectUpdate&id_donation=<?php echo $var->getId();?>">Editar</a>
				<a href="./index.php?controller=donation&action=delete&id_donation=<?php echo $var->getId();?>">Excluir</a><br>
			<?php }else { ?>
				<a href="./index.php?controller=donation&action=redirectFeedBack&id_donation=<?php echo $var->getId();?>">Realizar feedback</a><br>
			<?php }//end if é Moderador?>
			<p><b>Voluntário:</b></p> <?php echo $var->getVolunteer()->getName()?> 
			<p><b>Entidade:  </b></p> <?php echo $var->getEntity()->getName()?>
			<p><b>Moderador: </b></p> <?php echo $var->getModerator()->getLogin()?>
			<p><b>Mais informações:</b></p>
			<?php echo $var->getMoreInfo(); ?>
    <?php 
    $hasDonation = true;
	}?>
	<?php if ($hasDonation) {?>
	<hr>
	<?php } ?>
	</ul> 
<?php 
} 
?>