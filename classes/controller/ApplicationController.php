<?php
/**
 * Controller pai que terá o mesmo comportamento para todos os controllers do nosso sistema
 * 
 * Controller inicialmente com o método display que carrega o layout
 * Inicialmente com o método displayContent que colocará uma página html baseado no atributo page da requisicao
 * Todos os controller deverão herdar desse controller
 * Nome baseado no controller pai do Rails 
 */

include_once MODEL_PATH."/News.php";

class ApplicationController{

	/**
	 * Nossa view será declarada manipulada para exibição na classe pai
	 * As classes filhas só setarão o conteúdo das classes filhas
	 * @access protected 
	 * @name view
	 */
	protected $view;

	/**
	 * A requisicao será declarada na classe pai
	 * @access protected
	 * @name request
	 */
	protected $request;

	/**
	 * Maximo de resultados que se terá numa página
	 * 
	 * @name request
	 */
	protected $maxResults;

	public function __construct(Request $request){
		$this->request = $request;
		//Setando como 10 o valor do maximo de paginas
		$this->maxResults = 10;
		//$request->getUserType serve para saber o tipo de usuario e montar a view customizada
		$this->view = ServiceLocator::getInstance()->getView($this->request->getUserType());
	}

	/**
	  * Carrega a resposta diretamente sem passar pelo controller filho
	  * 
	  * Método ideal para carregar HTML sem passar pelos controllers
	  * Se não tivesse esse método, todos os controllers teriam que ter um método directDisplay 
	  * É OBRIGATÓRIO SETAR O ATRIBUTO "page" NA REQUISIÇÃO
	  */
	public function directDisplay(){
		
		$contentName = $this->request->get("page");
		$this->display($contentName);
	}

	/**
	  * Trata a exibição de páginas
	  * 
	  * Método que carrega o Layout principal de nossa página.
	  * Fica melhor no controller pai, pois exibir páginas é comum em todos os controllers.
	  * @param contentName
	  */
	protected function display($contentName){
		$this->view->display($contentName);
	}

	/**
	  * Envia requisições em JSON
	  * 
	  * Envia respostas ao usuário em formato JSON
	  * Método necessário para responder requisições AJAX
	  * Uso inicial para carregar campos filhos, quando o usuário clicar no campo pai.
	  *
	  */
	protected function displayJSON($arrayJSON){

	}

	/**
	  * Redireciona o usuario
	  * 
	  * Faz uma nova request para o servidor.
	  * Atributo page é a página que o usuário quer carrega
	  *
	  */
	protected function redirect($page = "Home"){
		$url = "./index.php?controller=Application&action=directDisplay&page=".$page;
		header("Location:".$url);
	}

	/**
	  * Encontra a página que o usuário se encontra na paginação
	  * 
	  * Atributo page é o número que o usuário se encontra
	  *
	  */
	protected function getPage(){
		$page = $this->request->get("page");

		if($page === null)
			$page = 0;

		return $page;
	}

	/**
	  * Realiza toda a lógica para imprimir paginação
	  * 
	  * Lógica de paginação que guarda na view o número total de páginas, a página atual do usuário e os usuários
	  *
	  */
	protected function assignPagination($currentPage, $users, $attributes){

		$pagesNum = ceil(count($users)/$this->maxResults);
		
		$url = $this->request->getRequestUrl($attributes);

		//setar a url para ser usada na view
		$this->view->assign("url", $url);

		//Número de paginas totais 
		$this->view->assign("pagesNum", $pagesNum);

		//Página atual que o usuário está 
		$this->view->assign("currentPage", $currentPage);

		//Lista de usuários para nossa view iterar sobre
		$this->view->assign("users", $users);
	}

	public function sendEmail($mailTo, $subject, $message, $headers){
		$subject = "JCI - Londrina: ". $subject;
		mail($mailTo, $subject, $message, $headers);
	}
}
?>