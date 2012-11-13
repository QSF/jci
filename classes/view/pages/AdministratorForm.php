<?php if(!isset($user)){
		$user = new Administrator;
		$action="create";}?>

<?php if ($action == 'create')
		$buttonName="Cadastrar";
	  else if ($action == 'update')
	  	$buttonName="Editar";
?>

<form action="./index.php?controller=registration&action=<?php echo $action?>" method="post">
<input type="hidden" name="user" value="Administrator"/>
<input type="hidden" name="user_id" value="<?php if(isset($user))echo $user->getId()?>"/>

	<?php if ($action == 'update') {//exibe se quer ou não alterar a senha?>
		<label class="checkbox">
			<input type="checkbox" name="changePassword" checked="yes"> Manter a senha.
			<input type="hidden" name="oldPassword" value="<?php echo $user->getPassword()?>"/>
		</label>
	<?php } ?>

	<label for="password">Senha</label>
	<input type="password" id="idPassword" name="password" value="<?php echo $user->getPassword()?>"/>

	<label for="email">E-mail</label>
	<input type="text" id="idEmail" name="email" value="<?php echo $user->getEmail()?>"/>
	
	<br/>
    <button type="submit" class="btn"><?php echo $buttonName; ?></button>
    
</form>