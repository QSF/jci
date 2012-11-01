<?php

/**
 * Controller que cuida da manipulação de noticias
 * 
 */

class NewsController extends ApplicationController{

	public function get(){
		$newsId = $this->request->get("news_id");
		
		$news = new News;
		$news->setId($newsId);

		$dao =  ServiceLocator::getInstance()->getDAO("DAO");
		$news = $dao->findById($news);

		$this->view->assign("news",$news);

		$this->view->display("NewsProfile");
	}

	private function buildNews($news){
		$public = $this->request->get('public') == null ? false : true;
		$news->setPublic($public);

		$news->setTitle($this->request->get("title"));

		$news->setContent($this->request->get("content"));
	}

	public function sendNews(){
		$news = new News;
	
		$this->buildNews($news);
		

		$mod = $this->request->getUserSession();
		if(get_class($mod) != "Moderator"){
			return;
		}
		
		//Colocando moderador como managed
		$dao = ServiceLocator::getInstance()->getDAO("DAO");
		
		$mod = $dao->findById($mod);
		
		$news->setAuthor($mod);
		$dao->insert($news);

		//Nao sei se eh melhor fazer o envio de noticias mandar por e-mail
		//ou fazer a gerencia

		$this->view->assignSuccess("Notícia Enviada");
		$this->view->display("Home");
	}	

	public function sendNewsByEmail(){

		$userDao =  ServiceLocator::getInstance()->getDAO("UserDAO");
		$users = $userDao->getAllNotifiedUsers();

		foreach($users as $user){
			$emailTo = $user->getEmail();
			$title = $news->getTitle();
			$content = $news->getContent();
			$emailFrom = "From:". emailJCI;
			//Tem que configurar o servidor de e-mail para funcionar
			//$this->sendEmail($emailTo, $title, $content, $emailFrom);
		}
	}

	public function deleteNews(){
		$newsId = $this->request->get("news_id");
		
		$news = new News;
		$news->setId($newsId);

		$dao =  ServiceLocator::getInstance()->getDAO("DAO");
		$news = $dao->findById($news);

		$dao->delete($news);

		$this->view->assignSuccess("A notícia foi excluida com sucesso");
		$this->view->display("Home");	
	}

	public function redirectUpdate(){
		$newsId = $this->request->get("news_id");
		
		$news = new News;
		$news->setId($newsId);

		$dao =  ServiceLocator::getInstance()->getDAO("DAO");
		$news = $dao->findById($news);

		$this->view->assign("news",$news);

		$this->view->assign("action", "./index.php?controller=news&action=update");
		$this->view->display("NewsForm");
	}

	public function update(){
		$newsId = $this->request->get("news_id");
		
		$news = new News;
		
		$this->buildNews($news);
		$news->setId($newsId);

		$dao =  ServiceLocator::getInstance()->getDAO("DAO");

		$mod = new Moderator;
		$mod->setId($this->request->get("author_id"));
		
		$news->setAuthor($dao->findById($mod));
		$dao->update($news);

		$this->view->assignSuccess("Notícia editada com sucesso");
		$this->view->display("Home");
	}

	public function getNews(){
		$page = $this->getPage("page");

		$pagePosition = $page * $this->maxResults;
		$dao = ServiceLocator::getInstance()->getDAO("NewsDAO");
		$news = $dao->getNews($pagePosition, $this->maxResults);

		$this->request->setRequestAction("news", "getNews");

		$pagesNum = ceil(count($news)/$this->maxResults);
		
		$url = $this->request->getRequestUrl();

		$this->view->assign("url", $url);
 
		$this->view->assign("pagesNum", $pagesNum);
 
		$this->view->assign("currentPage", $page);

		$this->view->assign("news", $news);

		$this->display("NewsList");
	}
}