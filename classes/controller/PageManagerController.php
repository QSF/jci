<?php

/**
 * Controller que gerencia o conteúdo das páginas (Home, Quem Somos, O que fazemos...).
 * 
 */

class PageManagerController extends ApplicationController{

	public function getPage(){
		$pageName = $this->request->get("page_name");
		
		$page = new Page;
		$page->setName($pageName);

		$dao =  ServiceLocator::getInstance()->getDAO("PageDAO");
		$page = $dao->findById($page);

		$this->view->assign("pageContent", $page->getContent());

		$this->view->display($page->getName());
	}

	public function buildPage(){
		$pageName = $this->request->get("page_name");
		
		$page = new Page;
		$page->setName($pageName);
		$page->setContent("");

		$dao =  ServiceLocator::getInstance()->getDAO("PageDAO");
		$page = $dao->insert($page);	
	}

	/** 
	* Carrega lista de páginas que podem ser editadas e redireciona para uma página com lista.
	*/
	public function getPageList(){

		$pageDao = ServiceLocator::getInstance()->getDAO("PageDAO");
		$pages = $pageDao->findAll();
		$this->view->assign("pages", $pages);

		$page = 'PageList';
		$this->view->display($page);
	}

	public function redirectUpdate(){
		$pageName = $this->request->get("page_name");
		
		$page = new Page;
		$page->setName($pageName);

		$dao =  ServiceLocator::getInstance()->getDAO("PageDAO");
		$page = $dao->findById($page);

		$this->view->assign("page",$page);

		$this->view->display("PageForm");
	}

	public function update(){
		$pageName = $this->request->get("page_name");
		
		$page = new Page;
		
		$page->setContent($this->request->get("content"));

		$page->setName($pageName);

		$dao =  ServiceLocator::getInstance()->getDAO("PageDAO");

		$dao->update($page);

		$this->view->assignSuccess("Página editada com sucesso");

		$this->view->assign("pageContent", $page->getContent());
		$this->view->display($pageName);
	}
}
?>

