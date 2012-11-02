<?php
class ModeratorView extends View{

	public function __construct($layoutName = "Layout"){
		$this->assign("menu", "ModeratorMenu.php");
		//checar no html se essa variavel está setada
		$this->assign("userSection", "UserSection.php");
		parent::__construct($layoutName);
	}

}
?>