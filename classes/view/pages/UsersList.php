<h3>Lista de Usuários</h3>

<?php include HELPER_PATH."/Pagination.php";?>
<?php foreach($users as $user){ ?>
	
	<a href="./index.php?controller=registration&action=read&user_id=<?php echo $user->getId()?>
				&profile=<?php echo get_class($user)?>">
		<?php echo $user->getName()?>
	</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="./index.php?controller=registration&action=updateGET&user_id=<?php echo $user->getId()?>
		&form=<?php echo get_class($user)?>">
		Editar
	</a>
	&nbsp;&nbsp;
	<a href="./index.php?controller=registration&action=updateGET&user_id=<?php echo $user->getId()?>
		&user_type=<?php echo get_class($user)?>">
		Deletar
	</a>
	&nbsp;&nbsp;
	<?php if(isset($validateAction) && $validateAction === true) {?>
	<a href="./index.php?controller=moderator&action=validateEntity&user_id=<?php echo $user->getId()?>">
		Validar
	</a>
	<?php } ?>
	<br/>
	<?php } //end foreach dos usuarios?>

	<?php echoPagination($pagesNum, $currentPage, $url);?>