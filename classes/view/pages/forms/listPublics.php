<?php
if(!isset($public)){
		$public = new PublicServed;
}?>

<ul>
<?php
//lista todos os públicos
foreach ($publics as $var) {?>
	<li> <label class="radio">
		<input type="radio" name="id" value="<?php echo $var->getID()?>" > <?php echo $var->getName(); };?>
	</label>
</ul>
