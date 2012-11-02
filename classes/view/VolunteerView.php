<?php
class VolunteerView extends View{

	public function __construct($layoutName = "Layout"){
		$this->assign("menu", "VolunteerMenu.php");
		//checar no html se essa variavel está setada
		$this->assign("userSection", "UserSection.php");
		parent::__construct($layoutName);
	}

}
?>