<?php
//classe teste, por isso não está comentada

require_once (VIEW_PATH . "/View.php");

/**
* 
*/
class ViewFactory
{
	public function create ($name){
		return new View();
	}

	function __construct()
	{
		# code...
	}
}
?>