<ul>
<?php
	$arrayFieldsChild = array();
	//para cada campo macro chama o listar campos
		foreach ($fields as $var) {?>
		<li>
		<?php  $arrayFieldsChild[$var->getId()] = listFields($var,$user);

		} ?>


</ul>

<?php
	
// Helper que lista os campos macros.
// Os campos filhos serão atualizados por AJAX
function listFields($var,$user){
	$arrayFields = array(); 

	printCheckbox($var, $user);
	 //children_xxx Div responsável por ser o container dos campos macros ?>
	<div id="children_<?php echo $var->getId() ?>">

		<?php //Utilizado para quando o formulário for de edição e necessário para
			 // não perder os valores dos campos filhos 
			foreach($var->getChildren() as $child){
				if( hasId($child->getId(),$user->getActingArea()) ){
					printChildren($var->getChildren(), $user);
					// Utilizado para parar a iteração dos filhos
					break;
				}	
			}
		?>
	</div>
	<?php 
	return $arrayFields; } ?>

<?php 
function printCheckbox($field, $user){
?>

<label class="checkbox">
	<input type="checkbox" name="actingArea[]" value="<?php echo $field->getID();?>" 
	id="checkbox<?php echo $field->getId()?>" class="actingArea"
	<?php if( hasId($field->getId(),$user->getActingArea()) ){
		echo "checked=yes";
	}
	?> >
	<?php echo $field->getName(); ?>
</label>
<?php }  ?>

<?php 
function printChildren($arrayFields, $user){

	foreach($arrayFields as $field){
		printCheckbox($field, $user);		
	}
}
?>

