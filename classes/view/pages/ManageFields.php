<h1> Campos de formulário</h1>


<form action="" method="post">
	<!-- listar campos -->
	<input type="submit" value="Editar"/>
	<input type="submit" value="Excluir"/>
	<input type="submit" value="Editar"/>
	
</form>
<?php if(!isset($user)){
		$user = new Moderator;
		$action="create";}?>
<form action="./index.php?controller=registration&action=<?php echo $action?>" method="post">
<input type="hidden" name="user" value="Moderator"/>
<input type="hidden" name="user_id" value="<?php if(isset($user))echo $user->getId()?>"/>

	<label for="name">Nome de Usuário</label>
	<input type="text" id="idLogin" name="login" value="<?php echo $user->getLogin()?>"/><br/>

	<?php if($user->getId() == null ){ ?>
	<label for="password">Senha</label>
	<input type="password" id="idPassword" name="password"/><br/>
	<?php } ?>

	<label for="email">E-mail</label>
	<input type="text" id="idEmail" name="email" value="<?php echo $user->getEmail()?>"/><br/>

	
<br/>
<input type="submit" value="Cadastrar"/>
</form>

        <form name="formCadastraUsuario" method="post" action="doCadastroUsuario" enctype="multipart/form-data">
            Nome: <input name="nome" type="text" size="50"><br/>
            Login: <input name="login" type="text" size="15"><br/>
            Senha: <input name="senha" type="password" size="15"><br/>
            Escolha uma imagem para seu perfil <br/>
            <input name="imagem" type="file" accept="image/*" ><br/><br/> 
            <input type="submit" value="Cadastrar">
            <input type="reset" value="Limpar">
        </form>