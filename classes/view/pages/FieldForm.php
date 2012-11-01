<?php if(!isset($field)){
		$field = new Field;
		$action="create";}?>

<!-- form de cadastro ou edição de campos -->
<form name="formField" action="./index.php?controller=field&action=<?php echo $action?>" method="post">
	<input type="radio" name="id" value="macro" <?php if($field->getParent()===null){echo "checked=\"checked\"";}?> > Este campo é macro<br>
	<!-- lista todos os campos para selecionar um deles como pai -->
	<?php require_once VIEW_PATH . "/pages/forms/listFields.php"; ?>
	
	<!-- field_id é o ID do campo que está sendo editado -->
	<input type="hidden" name="field_id" value="<?php echo $field->getId()?>"/>
	<label><input type="text" name="name" value="<?php echo $field->getName()?>"/>

	</label>
	<button type="submit" class="btn">Concluir</button>
</form>

