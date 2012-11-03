<?php
if(!isset($field)){
		$field = new Field;
}?>

<ul>
<?php
//para cada campo macro chama o listar campos
foreach ($fields as $var) {?>
	<li> <?php listFields($var,$field);
}?>
</ul>
<?php 
function listFields($var,$field){
	
	if($var == $field->getParent()){
		$checked = "CHECKED";
	} //coloar label?>
	<input type="radio" name="id" value="<?php echo $var->getID()?>" <?php echo $checked ?> > <?php echo $var->getName() ?>
	<ul>
		
	<?php 

	foreach ($var->getChildren() as $child) { ?>
		<li><?php listFields($child,$field); }?>
	</ul>
<?php } ?>