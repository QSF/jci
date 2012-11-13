<?php

	function arrayToCommaString($array){
		return implode(', ',$array);
	}

	function displayAttribute($array){
		echo "<table style=\"border:0;border-style: none;\" cellpadding=\"5\" >";
		foreach($array as $key=>$value){
			if($value !== null && $value !== ""){
				echo '<tr>';
				echo '<td>' . $key . '</td>';
				echo '<td>' . $value . '</td>';
				echo '</tr>';
			}


		}
		echo '</table>';
	}
?>