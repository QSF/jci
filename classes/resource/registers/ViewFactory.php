<?php
//classe teste, por isso não está comentada
require_once (REGISTERS_PATH . "/Register.php");
require_once (VIEW_PATH . "/View.php");

/**
* 
*/
class ViewFactory implements Register
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