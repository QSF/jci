<h3>Lista de Usuários</h3>

<?php include HELPER_PATH."/Pagination.php";?>
<?php foreach($users as $user){ ?>
  <span class="manage-list">
	<label>
	<a style="text-decoration: none;" href="./index.php?controller=registration&action=read&user_id=<?php echo $user->getId()?>
				&profile=<?php echo get_class($user)?>">
		<?php echo $user->getName()?>
	</a>
	</label>
	
	<a style="text-decoration: none;" href="././index.php?controller=registration&action=redirectUserUpdate&user_id=<?php echo $user->getId()?>
		&form=<?php echo get_class($user)?>">
		<i class="icon-edit"></i>
	</a>
	
	<a style="text-decoration: none;" href="./index.php?controller=registration&action=redirectUserDelete&user_id=<?php echo $user->getId();?>
		&user_type=<?php echo get_class($user);?>">
		<i class="icon-remove"></i>
	</a>
	
	<?php if(isset($validateAction) && $validateAction === true) {?>
	<a style="text-decoration: none;" href="./index.php?controller=moderator&action=validateEntity&user_id=<?php echo $user->getId()?>">
		Validar
	</a>
	<?php } ?>
	 </span><br/><hr>
	<?php } //end foreach dos usuarios?>

	<?php echoPagination($pagesNum, $currentPage, $url);?>