<?php 
/**
*	Função que exibe os feedbacks
*/
function printFeedBack($var){ ?>
	<?php if ($var->getDateFeedBackVolunteer() != null) {?>
	<p>***FeedBack Voluntário***</p> 
	<b>Data do feedBack: </b><?php echo $var->getDateFeedBackVolunteer()->format('d/m/Y H:i:s'); ?>
	<p><?php echo $var->getFeedBackVolunteer(); ?></p> 
	<?php } ?>

	<?php if ($var->getDateFeedBackEntity() != null) { ?>
	<p>***FeedBack Entidade***</p> 
	<b>Data do feedBack: </b><?php echo $var->getDateFeedBackEntity()->format('d/m/Y H:i:s'); ?>
	<p><?php echo $var->getFeedBackEntity(); ?></p> 
	<?php } ?>
<?php
}?>

<?php
/**
*	Função que exibe os dados de uma doação.
*/
function printSingleDonation($var){?>
	<b>Dia: </b><?php echo $var->getDate()->format('d/m/Y'); ?>
	<p><b>Voluntário:</b></p> <?php echo $var->getVolunteer()->getName()?> 
	<p><b>Entidade:  </b></p> <?php echo $var->getEntity()->getName()?>
	<p><b>Moderador: </b></p> <?php echo $var->getModerator()->getLogin()?>
	<p><b>Mais informações:</b></p>
	<?php echo $var->getMoreInfo();
}?>

<?php
/**
*	Função que exibe uma doação por completa, com links e tudo mais.
*/
function printDonation($var, $isModerador){?>
	<?php
	printSingleDonation($var);
	if ($isModerador) { //é página de Moderador?>
		<br><a href="./index.php?controller=donation&action=redirectUpdate&id_donation=<?php echo $var->getId();?>">Editar</a>
		<a href="./index.php?controller=donation&action=delete&id_donation=<?php echo $var->getId();?>">Excluir</a>
		<?php printFeedBack($var); ?>
	<?php }else { ?>
		<br><a href="./index.php?controller=donation&action=redirectFeedBack&id_donation=<?php echo $var->getId();?>">Realizar feedback</a>
	<?php }//end if é Moderador
}
?>

<?php 
/**
*	Função que lista várias doações, com os links.
*/
function listDonations($donations,$isModerador){	?>
	<ul>
	<?php 
		$hasDonation = false; //para colocar a linha no final.
		foreach ($donations as $var){?>
			<hr><li><?php printDonation($var,$isModerador) ?>
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