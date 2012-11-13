<?php

/**
 * Controller que contém as ações do moderador
 * 
 * Esse controller terá ações como pegar as entidades que estão esperando validação e validar entidade
 * Esse controller também faz uso da paginação.
 */

class ModeratorController extends ApplicationController{

	/** 
	* Dao que realiza o crud que nossas classes irão usar
	*/
	private $dao;

	public function __construct(Request $request){
		parent::__construct($request);	
		$this->dao = ServiceLocator::getInstance()->getDAO("DAO");
	}

	/** 
	* Método que mostra as entidades que estão esperando validação
	* Ele utiliza o método getEntitiesNegativeSituation do ModeratorDAO.
	* Para mostrar os resultados ele seta o numero de paginas totais e a página atual que usuário está. 
	*/
	public function getEntitiesWaitingApproval(){
		
		//Pegando pagina enviada pelo usuario no AppController
		$page = $this->getPage();

		//Saber qual a posição que essas páginas estão no DAO
		$pagePosition = $page * $this->maxResults;
		$dao = ServiceLocator::getInstance()->getDAO("EntityDAO");
		$users = $dao->getEntitiesNegativeSituation($pagePosition, $this->maxResults);

		$this->request->setRequestAction("moderator", "getEntitiesWaitingApproval");
		$this->assignPagination($page, $users, null);

		//Variavel que precisa ser setada para mostrar a acao de validar no UsersList
		$this->view->assign("validateAction",true);

		$this->display("UsersList");
	}

	/** 
	* Método que efetivamente valida as entidades
	* Esse método seta o campo situation do usuário
	*/
	public function validateEntity(){
		$userId = $this->request->get("user_id");
	
		$entity = new Entity;
		$entity->setId($userId);
		
		$dao = ServiceLocator::getInstance()->getDAO("EntityDAO");
		$dao->validateEntity($entity);

		//Variavel que precisa ser setada para mostrar a acao de validar no UsersList
		$this->view->assignSuccess("Entidade Validada com sucesso!",true);
		$this->view->assign("validateAction",true);

		$this->view->display("Home");
	}

	public function findAll(){

		$page = $this->getPage("page");
		$userType = $this->request->get("userType");

		$pagePosition = $page * $this->maxResults;
		$dao = ServiceLocator::getInstance()->getDAO("UserDAO");
		$users = $dao->findAllPaginated($userType, $pagePosition, $this->maxResults);

		$this->request->setRequestAction("moderator", "findAll");
		$attributes['userType'] = $userType;
		$this->assignPagination($page, $users, $attributes);

		$this->display("UsersList");
	}

	public function search(){

		$searchOption = $this->request->get("searchOption");
		$searchWord = $this->request->get("searchField");

		$page = $this->getPage();

		$pagePosition = $page * $this->maxResults;
		$dao = ServiceLocator::getInstance()->getDAO("UserDAO");
		if($searchOption == 'documents'){}
			//$this->setDocuments();
		
		$users = $dao->search($searchWord, $searchOption, $pagePosition, $this->maxResults);

		$this->request->setRequestAction("moderator", "search");
		$attributes['searchOption'] = $searchOption;
		$attributes['searchField'] = $searchWord;
		$this->assignPagination($page, $users, $attributes);

		$this->display("UsersList");
	}

	/**
	*	Método que redireciona para uma página de busca de usuário com filtro por área de atuação(campo)
	*/
	public function redirectSearchField(){
		$fieldDao = ServiceLocator::getInstance()->getDAO("FieldDAO");
		$fields = $fieldDao->findAllMacros();//pega todos os campos macros
		$this->view->assign("fields", $fields);

		$page = 'UserSearchField';
		$this->view->display($page);
	}

	/**
	*	Método que busca usuário de acordo com o campo passado.
	*/
	public function searchByField(){

		$page = $this->getPage();

		$pagePosition = $page * $this->maxResults;

		$fieldId = $this->request->get("id");

		if ($fieldId === null){
			$this->view->assignError('Campo não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$field = new Field;
		$field->setId($fieldId);

		$field = $this->dao->findById($field);

		if ($field == null){
			$this->view->assignError('Campo não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;	
		}

		$userDao = ServiceLocator::getInstance()->getDAO("UserDAO");

		$users = $userDao->getUsersByField($field);

		if ($this->request->get('listParent') != null){//lista os pais
			while ($field->getParent() != null){
				$field = $field->getParent();
				$parentUsers = $userDao->getUsersByField($field);
				foreach ($parentUsers as $user) {
					if (!in_array($user, $users))//ver se um user já não está no array de users
						array_push($users,  $user);
				}
			}
		}

		// $this->request->setRequestAction("moderator", "searchByField");
		$attributes['id'] = $fieldId;
		$this->assignPagination($page, $users, $attributes);

		$users = array_slice($users, $pagePosition, $this->maxResults);
		$this->view->assign("users", $users);
		$this->display("UsersList");
	}

	/**
	*	Método que redireciona para uma página de busca de usuário com filtro por público atendido.
	*/
	public function redirectSearchPublic(){
		$fieldDao = ServiceLocator::getInstance()->getDAO("PublicServedDAO");
		$publics = $fieldDao->findAll();
		$this->view->assign("publics", $publics);

		$page = 'UserSearchPublic';
		$this->view->display($page);
	}

	/**
	*	Método que busca usuário de acordo com o público passado.
	*/
	public function searchByPublic(){

		$page = $this->getPage();

		$pagePosition = $page * $this->maxResults;

		$publicId = $this->request->get("id");

		if ($publicId === null){
			$this->view->assignError('Público não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$public = new Field;
		$public->setId($publicId);

		$public = $this->dao->findById($public);

		if ($public == null){
			$this->view->assignError('Público não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;	
		}

		$userDao = ServiceLocator::getInstance()->getDAO("UserDAO");

		$users = $userDao->findUsersByPublic($public, $pagePosition, $this->maxResults);

		$attributes['id'] = $publicId;
		$this->assignPagination($page, $users, $attributes);

		$this->view->assign("users", $users);
		$this->display("UsersList");
	}
}
?>