<ul>
<?php
	//para cada campo macro chama o listar campos
	foreach ($fields as $var) {?>
		<li> <?php listFields($var,$user);
	}
?>
</ul>

<?php 
function listFields($var,$user){
	?>
	<label class="checkbox">
	<input type="checkbox" name="actingArea[]" value="<?php echo $var->getID()?>" 
	<?php if( hasId($var->getId(),$user->getActingArea()) ){
		echo "checked=yes";
	}
	?> >
	<?php echo $var->getName() ?>
	</label>
	<ul>
	<?php 
		foreach ($var->getChildren() as $child){ ?>
			<li><?php listFields($child,$user); 
		}
	?>
	</ul> <?php 
} 
?>