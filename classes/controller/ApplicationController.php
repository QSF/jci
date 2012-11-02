<?php
/**
 * Controller pai que terá o mesmo comportamento para todos os controllers do nosso sistema
 * 
 * Controller inicialmente com o método display que carrega o layout
 * Inicialmente com o método displayContent que colocará uma página html baseado no atributo page da requisicao
 * Todos os controller deverão herdar desse controller
 * Nome baseado no controller pai do Rails 
 */

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

	public function __construct(Request $request){
		$this->request = $request;

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
}

?>