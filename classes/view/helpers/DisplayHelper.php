<?php
	function displayAttribute($array){
		foreach($array as $key=>$value){
			if($value !== null && $value !== ""){
				echo $key ."  =  ". $value;
				echo "<br/>";
			}
		}
	}
?>