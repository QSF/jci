<?php

include_once CLASSES_PATH."/PDF.php";

function fieldCompare($a,$b){
	if(count($a->getActingArea())  == count($b->getActingArea()))
		return 0;
	   return (count($a->getActingArea()) < count($b->getActingArea()) ? -1 : 1);
}

class ReportController extends ApplicationController{


	public function redirectSet(){
		
		$fieldDao = ServiceLocator::getInstance()->getDAO("FieldDAO");
		$fields = $fieldDao->findAllMacros();//pega todos os campos macros
		//Todos os campos serão exibidos na view.
		$this->view->assign("fields", $fields);

		$this->display("generateReport");
	}

	public function generateReportField(){
		$fieldId = $this->request->get("id");

		$field = new Field;
		$field->setId($fieldId);

		$dao = ServiceLocator::getInstance()->getDAO("DAO");
		$field = $dao->findById($field);

		$userDao = ServiceLocator::getInstance()->getDAO("UserDAO");

		//Pegando usuários que tem o mesmo campo
		$users = $userDao->getUsersByField($field);

		//dois arrays para manipulação dos dados
		$volunteersArray = array();
		$entitiesArray = array();

		//Separando as entidades dos voluntários
		foreach($users as $user){
			if(get_class($user) == "Entity"){
				array_push($entitiesArray,$user);
			}
			else{
				array_push($volunteersArray,$user);
			}
		}

		usort($entitiesArray, 'fieldCompare');
		usort($volunteersArray, 'fieldCompare');

		$moderator = $this->request->getUserSession();

		$pdf = new PdfGenerator($moderator);
		$pdf->generateReportField($volunteersArray, $entitiesArray, $field);  
	}

	public function generateReportUser(){

	}

}