<?php
if(!isset($field)){
		$field = new Field;
}?>

<ul>
<?php
//para cada campo macro chama o listar campos
foreach ($fields as $var) {?>
	<li> <input type="radio" name="id" value="<?php echo $var->getID()?>" > <?php echo $var->getName() }?>
</ul>
