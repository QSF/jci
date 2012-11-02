<form  action="./index.php?controller=login&action=<?php echo $action?>" method="post">
	
	<?php echo $nameDisplay ?><input type="text" name="<?php echo $inputType?>"/><br/>
	Senha <input type="password" name="password"/><br/>
	<input type="submit" value="Login"/>

</form>