<?php 
function listDonations($donations){	?>
	<ul>
	<?php 
		foreach ($donations as $var){?>
	
			<li> <?php echo $var->getVolunteer()->getName() . " " . 
				$var->getEntity()->getName() . " " . $var->getModerator()->getLogin() . 
				" " . $var->getDate()->format('d/m/Y'); ?>
			<a href="./index.php?controller=donation&action=redirectUpdate&id_donation=<?php echo $var->getId();?>">Editar</a>
			<a href="./index.php?controller=donation&action=delete&id_donation=<?php echo $var->getId();?>">Editar</a>
    <?php }?>
	
	</ul> 
<?php 
} 
?>