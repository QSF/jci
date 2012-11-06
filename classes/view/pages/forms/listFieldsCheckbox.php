<ul>
<?php
	$arrayFieldsChild = array();
	//para cada campo macro chama o listar campos
		foreach ($fields as $var) {?>
		<li>
		<?php  $arrayFieldsChild[$var->getId()] = listFields($var,$user);

		} ?>


</ul>
<div id="childFields"> </div>

<script type="text/javascript"> var arrayJSONChildren = 
<?php echo utf8_encode(json_encode($arrayFieldsChild));?> </script>

<?php

function listFields($var,$user){
	$arrayFields = array(); 
	?>
	
	<input type="checkbox" name="actingArea[]" value="<?php echo $var->getID();?>" 
	id="checkbox<?php echo $var->getId()?>" class="actingArea"
	<?php if( hasId($var->getId(),$user->getActingArea()) ){
		echo "checked=yes";
	}
	?> >
	<?php echo $var->getName() ?>
	</label>
	<ul>
	<?php 
		foreach ($var->getChildren() as $child){
			listFields($child,$user);
			array_push($arrayFields, array("id" => $child->getId(), "name" => $child->getName()));
		}  ?>
	</ul>  

	<?php 
	return $arrayFields; } ?>
