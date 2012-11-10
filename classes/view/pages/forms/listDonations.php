<?php 
function listDonations($donations){	?>
	<ul>
	<hr>
	<?php 
		foreach ($donations as $var){?>
			<li>
			<?php echo $var->getDate()->format('d/m/Y'); ?>
			<a href="./index.php?controller=donation&action=redirectUpdate&id_donation=<?php echo $var->getId();?>">Editar</a>
			<a href="./index.php?controller=donation&action=delete&id_donation=<?php echo $var->getId();?>">Excluir</a><br>

			<p><b>Voluntário:</b></p> <?php echo $var->getVolunteer()->getName()?> 
			<p><b>Entidade:  </b></p> <?php echo $var->getEntity()->getName()?>
			<p><b>Moderador: </b></p> <?php echo $var->getModerator()->getLogin()?>
			<p><b>Mais informações:</b></p>
			<?php echo $var->getMoreInfo(); ?>
			<hr>
    <?php }?>
	
	</ul> 
<?php 
} 
?>