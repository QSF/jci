<h3>Lista de Usuários</h3>

<?php include HELPER_PATH."/Pagination.php";?>
<?php foreach($users as $user){ ?>
	
	<a href="./index.php?controller=registration&action=read&user_id=<?php echo $user->getId()?>
				&profile=<?php echo get_class($user)?>">
		<?php echo $user->getName()?>
	</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="././index.php?controller=registration&action=redirectUserUpdate&user_id=<?php echo $user->getId()?>
		&form=<?php echo get_class($user)?>">
		<img src="PUBLIC_PATH."img/icons/Edit.ico"">
	</a>
	&nbsp;&nbsp;
<<<<<<< HEAD
	<a href="./index.php?controller=registration&action=delete&user_id=<?php echo $user->getId()?>
		&user_type=<?php echo get_class($user)?>">
		<img src="PUBLIC_PATH."img/icons/Delete.ico"">
=======
	<a href="./index.php?controller=registration&action=redirectUserDelete&user_id=<?php echo $user->getId();?>
		&user_type=<?php echo get_class($user);?>">
		Deletar
>>>>>>> 3cc065ecb2a4b505d86d040f5b0a70ade63c81a7
	</a>
	&nbsp;&nbsp;
	<?php if(isset($validateAction) && $validateAction === true) {?>
	<a href="./index.php?controller=moderator&action=validateEntity&user_id=<?php echo $user->getId()?>">
		<img src=" PUBLIC_PATH."img/icons/Validate.ico"">
	</a>
	<?php } ?>
	<br/>
	<?php } //end foreach dos usuarios?>

	<?php echoPagination($pagesNum, $currentPage, $url);?>