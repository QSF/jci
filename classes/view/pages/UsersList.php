<h3>Lista de Usuários</h3>

<?php include HELPER_PATH."/Pagination.php";?>

<?php echoPagination($pagesNum, $currentPage, $url);?>

<?php foreach($users as $user){ ?>
	<div class="grid_8 alpha omega bolder">
	<div class="grid_5 alpha">
	<a style="text-decoration: none;" href="./index.php?controller=registration&action=read&user_id=<?php echo $user->getId()?>
				&profile=<?php echo get_class($user)?>" title="Visualizar Perfil">
		<?php echo $user->getName()?>
	</a>
	</div>
	<div class="grid_3 omega">
	<a style="text-decoration: none;" href="././index.php?controller=registration&action=redirectUserUpdate&user_id=<?php echo $user->getId()?>

		&form=<?php echo get_class($user)?>" title="Editar">
		<i class="icon-edit"></i>
	</a>

	&nbsp;&nbsp;
	
	<?php if(! isset($hideReport)) {?>	
	<a href="./index.php?controller=report&action=generateReportUser&user_id=<?php echo $user->getId();?>
		&user_type=<?php echo get_class($user);?>" title="Gerar Relatório">
		<i class="icon-print"></i>
	</a>
	&nbsp;&nbsp;
	<?php } ?>	

	
	<a style="text-decoration: none;" href="./index.php?controller=registration&action=redirectUserDelete&user_id=<?php echo $user->getId();?>
		&user_type=<?php echo get_class($user);?>" title="Remover">
		<i class="icon-remove"></i>
	</a>

	&nbsp;&nbsp;
	
	<?php if(isset($validateAction) && $validateAction === true) {?>
	<a style="text-decoration: none;" href="./index.php?controller=moderator&action=validateEntity&user_id=<?php echo $user->getId()?>" 
					title="Validar Entidade">
		<i class="icon-thumbs-up"></i>
	</a>
	&nbsp;&nbsp;
	<?php } ?>
	
	<?php if(isset($activateAction) && $activateAction === true) {?>
	<a style="text-decoration: none;" href="./index.php?controller=moderator&action=activateUser&user_id=<?php echo $user->getId()?>
		&user_type=<?php echo get_class($user);?>" title="Ativar Usuários">
		<i class="icon-retweet"></i>
	</a>
	&nbsp;&nbsp;
	<?php } ?>

	<a href="./index.php?controller=donation&action=redirectUserDonations&user_id=<?php echo $user->getId()?>&user_type=<?php echo get_class($user)?>" title="Veja o histórico de doações">
	Doações</a>
	
	</div>
	</div>
	<br/><hr>
	<?php } //end foreach dos usuarios?>
	<?php echoPagination($pagesNum, $currentPage, $url);?>