<input type="checkbox" name="receivedNotification" 
<?php if($user->getReceiveNotification()) echo "checked=yes";?>
value="yes"/>Receber notificações da JCI por email<br/>

<label for="name">Nome</label>
<input type="text" id="idName" name="name" value="<?php echo $user->getName()?>"/><br/>

<label for="email">E-mail</label>
<input type="text" id="idEmail" name="email" value="<?php echo $user->getEmail()?>"/><br/>

<?php if($user->getId() == null ){ ?>
	<label for="password">Senha</label><br/>
	<input type="password" id="idPassword" name="password"/><br/>
<?php } ?>

<?php if($user->getId() == null ){ ?>
	<label for="confirmPassword">Confirmação de Senha</label><br/>
	<input type="password" id="idConfirmPassword" name="confirmPassword"/><br/>
<?php } ?>

<label for="phone">Telefone</label><br/>
<input type="text" id="idPhone" name="phone" value="<?php  echo $user->getPhone()?>"/><br/>

<label for="howYouKnow">Como ficou sabendo sobre a JCI Londrina/Projeto Canal de Voluntários?</label>
<input type="text" id="idHowYouKnow" name="howYouKnow" value="<?php echo $user->getHowYouKnow()?>"><br/>

<label>Público</label><br/>
<?php require_once VIEW_PATH . "/pages/forms/listPublicsCheckbox.php"; ?>

<label >Área de atuação</label><br/>
<?php require_once VIEW_PATH . "/pages/forms/listFieldsCheckbox.php"; ?>

<label for="cep">CEP</label>
<input type="text" id="idCep" name="cep" value="<?php echo $user->getCep()?>"/><br/>
