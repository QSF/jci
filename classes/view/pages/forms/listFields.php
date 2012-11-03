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
	$checked = "";
	if($field->getParent() != null && $var->getId() == $field->getParent()->getId()){
		$checked = "checked=\"checked\"";
	} //coloar label?>
	<input type="radio" name="id" value="<?php echo $var->getID()?>" <?php echo $checked ?> > <?php echo $var->getName() ?>
	<ul>
		
	<?php 

	foreach ($var->getChildren() as $child) { ?>
		<li><?php listFields($child,$field); }?>
	</ul>
<?php } ?>