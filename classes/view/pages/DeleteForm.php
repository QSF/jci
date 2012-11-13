Confirme sua senha para remover o usuário <?php if(isset($userName)) echo $userName ?>.
<br/>
<br/>
<form  action="./index.php?controller=registration&action=delete" method="post">
	<input type="hidden" name="user_id"   value="<?php if(isset($userId)) echo $userId?>"/>
	<input type="hidden" name="user_type" value="<?php if(isset($userType))echo $userType ?>"/>
	<label for="passwrod">Senha</label>
	<input class="password" type="password" name="password"/><br/>
    <button type="submit" class="btn">Remover</button>
</form>