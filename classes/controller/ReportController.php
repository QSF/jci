<?php

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


		$users = $userDao->getUsersByField($field);
	}

	public function generateReportUser(){

	}

}