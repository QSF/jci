Confirme sua senha para remover o usuário <?php if(isset($userName)) echo $userName ?>.

<form  action="./index.php?controller=registration&action=delete" method="post">
	<input type="hidden" name="user_id"   value="<?php if(isset($userId)) echo $userId?>"/>
	<input type="hidden" name="user_type" value="<?php if(isset($userType))echo $userType ?>"/>

	Senha <input class="password" type="password" name="password"/><br/>
	<input type="submit" value="Remover"/>

</form>