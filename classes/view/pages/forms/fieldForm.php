<?php if(!isset($field)){
		$field = new Field;
		$action="create";}?>

<!-- form de cadastro ou edição de campos -->
<form name="formField" action="./index.php?controller=field&action=<?php echo $action?>" method="post">
	<input type="radio" name="id" value="macro" <?php if($action =="create"){echo "CHECKED"}?> > Este campo é macro<br>
	<!-- lista todos os campos para selecionar um deles como pai -->
	<?php require_once VIEW_PATH . "/pages/forms/ListFields.php"; ?>
	
	<input type="text" name="name" value="<?php echo $field->getName()?>"/>
	<!-- field_id é o ID do campo que está sendo editado -->
	<input type="hidden" name="field_id" value="<?php echo $field->getId()?>"/>


	<input type="submit" value="Concluir"/>
</form>

