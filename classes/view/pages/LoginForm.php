<form  action="./index.php?controller=login&action=<?php echo $action?>" method="post">
<table width="40%">
	<tr>
		<td><?php echo $nameDisplay ?><input type="text" name="<?php echo $inputType?>"/><br/></td>
		<td>Senha <input type="password" name="password"/><br/></td>
		<td><input type="submit" value="Login"/></td>
	</tr>
</table>
	

</form>