<?php

	function arrayToCommaString($array){
		return implode(', ',$array);
	}

	function displayAttribute($array){
		foreach($array as $key=>$value){
			if($value !== null && $value !== ""){
				?>
				<div class="grid_5 alpha bolder perfil">
					<?php echo $key; ?>
				</div>
				<div class="grid_3 omega perfil">
					<?php echo $value; ?>
				</div>
				<hr> 
				<?php
			}
		}
	}
?>