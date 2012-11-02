<?php
class GuestView extends View{

	public function __construct($layoutName = "Layout"){
	//	$this->assign("menu", "GuestMenu.php");
		//checar no html se essa variavel está setada
		$this->assign("userSection", "GuestSection.php");

		parent::__construct($layoutName);
	}

}
?>