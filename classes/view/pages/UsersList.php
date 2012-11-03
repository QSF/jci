<h3>Lista de Usuários</h3>

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
	<a href="./index.php?controller=moderator&action=validateEntity&user_id=<?php echo $user->getId()?>">
		Validar
	</a>
	<br/>

	<?php } //end foreach dos usuarios?>

<?php if($pagesNum > 1){ //Area da Paginação ?>
	<?php $url="./index.php?controller=moderator&action=getEntitiesWaitingApproval&page="?>
		<?php echo $page;if($page != 0) { //Verificando se nao é a primeira página. Caso for, não mostra o link anterior?>
		<a href="<?php echo $url.($page-1) ?>">
			Anterior &nbsp;
		</a>
		<?php } ?>
			
		<?php for($i = 0; $i < $pagesNum+1; $i++) { ?>
			<a href="<?php echo $url.$i ?>">
				<?php echo $i+1 ?>&nbsp;
			</a>
		<?php } ?>

		<?php if($page != $pagesNum) { ?>
			<a href="<?php echo $url.($page+1)?>">
				&nbsp; Próxima
			</a>
		<?php } // end if do proximo ?>

	<?php } //end if da paginação ?>