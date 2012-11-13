<?php require_once(VIEW_PATH . '/pages/forms/listUsers.php') ?>

<h4>Escolha um Usuário:</h4>	

<form action="./index.php?controller=donation&action=redirectUserDonations" method="post">

	<?php listUsers($users, $user, 'user_id'); ?>

	<input type="hidden" name="user_type" value="<?php echo get_class($user);?>">

	<input type="submit" class="btn" value="Buscar" >
</form>