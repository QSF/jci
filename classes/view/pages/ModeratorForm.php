<?php if(!isset($user)){
		$user = new Moderator;
		$action="create";}?>
<?php if (!isset($password)) $password = true; ?>

<form action="./index.php?controller=registration&action=<?php echo $action?>" method="post">
<input type="hidden" name="user" value="Moderator"/>
<input type="hidden" name="user_id" value="<?php if(isset($user))echo $user->getLogin()?>"/>

	<label for="name">Nome de Usuário</label>
	<input type="text" id="idLogin" name="login" value="<?php echo $user->getLogin()?>"/><br/>

	<?php if($user->getId() == null  || $password == true){ ?>
	<label for="password">Senha</label>
	<input type="password" id="idPassword" name="password"/><br/>
	<?php } ?>

	<label for="email">E-mail</label>
	<input type="text" id="idEmail" name="email" value="<?php echo $user->getEmail()?>"/><br/>

	
<br/>
<input type="submit" value="Cadastrar"/>
</form>