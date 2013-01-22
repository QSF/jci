<label class="checkbox">
<input type="checkbox" name="receivedNotification" <?php if($user->getReceiveNotification()) echo "checked=yes";?> value="yes"> Receber notificações da JCI por email
</label>

<label for="name">Nome</label>
<input type="text" id="idName" name="name" value="<?php echo $user->getName()?>"/>

<label for="email">E-mail</label>
<input type="text" id="idEmail" name="email" value="<?php echo $user->getEmail()?>"/>

<?php if ($action == 'update') {//exibe se quer ou não alterar a senha?>
<label class="checkbox">
<input type="checkbox" name="changePassword" checked="yes"> Manter a senha.
<input type="hidden" name="oldPassword" value="<?php echo $user->getPassword()?>"/>
</label>
<?php } ?>

<label for="password">Senha</label>
<input type="password" id="idPassword" name="password" value="<?php echo $user->getPassword()?>"/>

<label for="confirmPassword">Confirmação de Senha</label>
<input type="password" id="idConfirmPassword" name="confirmPassword" value="<?php echo $user->getPassword()?>"/>

<label for="phone">Telefone</label>
<input type="text" id="idPhone" name="phone" value="<?php echo $user->getPhone()?>"/>

<label for="howYouKnow">Como ficou sabendo sobre a JCI Londrina/Projeto Canal de Voluntários?</label>
<input type="text" id="idHowYouKnow" name="howYouKnow" value="<?php echo $user->getHowYouKnow()?>">

<label>Público</label>
<?php require_once VIEW_PATH."/pages/forms/listPublicsCheckbox.php"; ?>

<label >Área de atuação</label>
<?php require_once VIEW_PATH."/pages/forms/listFieldsCheckbox.php"; ?>


<label for="cep">CEP</label>
<input type="text" id="idCep" name="cep" value="<?php echo $user->getCep()?>"/>