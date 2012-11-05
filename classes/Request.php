<?php
require_once CLASSES_PATH . "/ObjectBuilder.php";
/**
 * Classe que encapsula a request
 *
 * Classe que tem o objetivo de pegar a requisicao e encapsulá-la.
 * Facilita a manipulação da requisição de outras classes que usarão os arrays superglobais $_POST e $_GET
 * @access public 
 * 
 * 
 */

class Request{
	
	/**
	 * Array que guarda os atributos da requsição GET
	 * @name requestArray
	 */
	private $requestGET = array();
		
	/**
	 * Array que guarda os atributos da requsição POST
	 * @name requestArray
	 */
	private $requestPOST = array();

	/**
	 * Nome do controller recebido por parâmetro na requisição
	 * 
	 * @name moduleName
	 * 
	 */
	private $controllerName;
	
	/**
	 * Nome da action recebida por parâmetro na requisição
	 * 
	 * @name actionName
	 */
	private $actionName;
	
	/**
	 * Atributo que guardo o tipo de método http da requisição
	 * Pode ser GET ou POST
	 * @name methodHttp
	 */
	private $methodHttp;
	
	/**
	 *Atributo que guarda um array de eventuais cookies que iremos precisar
	 *@name cookies
	 */
	private $cookies = array();
	
	/**
	 * Verifica se o método HTTP é GET ou POST e atribui esse array na variavel $array_request
	 */
	public function __construct(){
		
		$this->requestArrayGET = $_GET;
		$this->requestArrayPOST = $_POST;

		$this->cookies = $_COOKIE;

		$this->controllerName = $this->get("controller");
		$this->actionName = $this->get("action");	
	}
	
	/**
	 * Método que pega o atributo do array passado pelo parâmetro
	 * 
	 * @return Retorna o atributo da requisição
	 */
	public function get($name){
		//checando se existe atributo no método GET 
		if(isset($this->requestArrayGET[$name]))
			return $this->requestArrayGET[$name];

		//checando se existe atributo no método POST
		else if (isset($this->requestArrayPOST[$name]))
			return $this->requestArrayPOST[$name];

		return null;
	}
	
	/**
	 * Método que pega o atributo do array passado pelo parâmetro
	 * 
	 * @param attr_name  Nome do atributo a ser setado
	 * @param object  Objeto que será colocado na requisição
	 */
	public function set($nameAttr, $object, $method="GET"){
		if(isset($this->requestArrayGET[$nameAttr]) || $method === "GET")
			$this->requestArrayGET[$nameAttr] = $object;

		else if (isset($this->requestArrayPOST[$nameAttr]) || $method === "POST")
			$this->requestArrayPOST[$nameAttr] = $object ;
	}
	
	public function getControllerName(){
		return $this->controllerName;
	}
	
	public function setControllerName($controllerName){
		$this->controllerName = $controllerName;
	}
	
	public function getActionName(){
		return $this->actionName;
	}
	
	public function setActionName($actionName){
		$this->actionName = $actionName;
	}
	
	public function getCoookies(){
		return $this->cookies;
	}

	public function setCoookies($cookieName, $value){
		$this->cookies[$cookieName] = $value;
	}

	/**
	 * Método que retorna o papel do usuário do site
	 * 
	 * @return string Nome do cargo 
	 */
	public function getUserType(){
		
		//Checando se o usuário está autenticado no nosso sistema
		//Se não estiver, significa que é um visitante
		if(!isset($_SESSION["type"])){
			return "Guest";
		}
		
		return $_SESSION["type"];
	}

	/** Método que retorna um user de acordo com os dados passados no formulário.
	*	
	*	Está classe faz uso de um objeto do tipo ObjectBuilder, sendo que escolhe qual método dele chamar,
	*	através do parâmetro user passado da url (GET string).
	*
	*	@return user Um usuário do nosso sistema, dependendo do nosso tipo de user
	*	@return null se o valor do parâmetro user não está setado
	*
	*	@see ObjectBuilder
	*	@todo fazer para o moderador
	*/
	public function getUser(){
		$builder = new ObjectBuilder($this);
		//padronizar este user
		$userType = $this->get('user');
		if ($userType == null)
			return null;

		switch ($userType) {
			case 'Entity':
				$user = $builder->getEntity();
				break;
			case 'VolunteerNaturalPerson'://natural person
				$user = $builder->getVolunteerNaturalPerson();
				break;
			case 'VolunteerLegalPerson'://legal person
				$user = $builder->getVolunteerLegalPerson();
				break;
			case 'Moderator':
				$user = $builder->getModerator();
				break;
			default:
				$user = null;
				break;
		}

		return $user;
	}

	public function setRequestAction($controller, $action){
		$this->setControllerName($controller);
		$this->setActionName($action);
	}

	public function getRequestUrl($attributes = null){
		$url = "./index.php?controller=".$this->getControllerName()."&action=".$this->getActionName();
		if(isset($attributes)){
			foreach($attributes as $key => $value){
				$url = $url."&".$key."=".$value;
			} 
		}
		return $url;
	}

	public function getUserSession(){
		if($_SESSION["user"] == null)
			return null;
		
		$userSession = unserialize($_SESSION["user"]);

		return $userSession;
	}
}
?>