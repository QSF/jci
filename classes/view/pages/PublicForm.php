<?php if(!isset($public)){
		$public = new Field;
		$action="create";}?>

<!-- form de cadastro ou edição de campos -->
<form name="formField" action="./index.php?controller=public&action=<?php echo $action?>" method="post">
	
	<input type="text" name="name" value="<?php echo $public->getName()?>"/>

	<input type="hidden" name="id" value="<?php echo $public->getId()?>"/>


	<input type="submit" value="Concluir"/>
</form>

