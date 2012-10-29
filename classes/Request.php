<?php
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
	 * Array que guarda os atributos da requsição
	 * @name requestArray
	 */
	private $requestArray = array();
	
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
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			$this->requestArray = $_POST;
			$this->methodHttp = "POST";
		}
		else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
			$this->requestArray = $_GET;
			$this->methodHttp = "GET";
		}

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
		if(isset($this->requestArray[$name]))
			return $this->requestArray[$name];
		return null;
	}
	
	/**
	 * Método que pega o atributo do array passado pelo parâmetro
	 * 
	 * @param attr_name  Nome do atributo a ser setado
	 * @param object  Objeto que será colocado na requisição
	 */
	public function set(String $nameAttr, $object){
		$this->requestArray[$nameAttr] = $object;
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
	
	public function setActionNamae($actionName){
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
		if(!isset($_SESSION["role"])){
			$userRole = "VISITANTE";
		}
		else{
			$userRole = $_SESSION["role"];
		}
		
		return $userRole;
	}
}
?>