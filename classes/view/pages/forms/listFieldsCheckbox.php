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
	?>
	<label class="checkbox">
	<input type="checkbox" name="actingArea[]" value="<?php echo $var->getID();?>" 
	id="checkbox<?php echo $var->getId()?>" class="actingArea"
	<?php if( hasId($var->getId(),$user->getActingArea()) ){
		echo "checked=yes";
	}
	?> >
	<?php echo $var->getName() ?>
	</label>
	<div id="children_<?php echo $var->getId() ?>"></div>
	<?php 
	return $arrayFields; } ?>	


