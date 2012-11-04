<ul>
<?php
	//lista todos os públicos
	foreach ($publicArray as $var) { ?>
		<li><input type="checkbox" name="public[]" value="<?php echo $var->getId()?>" 
				<?php if( hasId($var->getId(),$user->getPublic()) ){ echo "checked=yes";}?> > 
			<?php echo $var->getName(); } ?>
	
	<?php	
	function hasId($id,$array){
		if ($array ==null){
			return false;
		}
		foreach ($array as $key) {
			if ($id == $key->getId()) {
					return true;
			}
		}
		return false;
	}
?>
</ul>