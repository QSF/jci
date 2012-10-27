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
	 * @name array_request
	 */
	private $array_request = array();
	
	/**
	 * Nome do controller recebido por parâmetro na requisição
	 * 
	 * @name module_name
	 * 
	 */
	private $model_name;
	
	/**
	 * Nome da action recebida por parâmetro na requisição
	 * 
	 * @name action_name
	 */
	private $action_name;
	
	/**
	 * Atributo que guardo o tipo de método http da requisição
	 * Pode ser GET ou POST
	 * @name method_http
	 */
	private $http_method;
	
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
			$this->array_request = $_POST;
			$this->http_method = "POST";
		}
		else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
			$this->array_request = $_GET;
			$this->http_method = "GET";
		}

		$cookies = $_COOKIE;
		$this->model_name = $this->get("model");
		$this->action_name = $this->get("action");

		
	}
	
	/**
	 * Método que pega o atributo do array passado pelo parâmetro
	 * 
	 * @return Retorna o atributo da requisição
	 */
	public function get($name){
		if(isset($this->array_request[$name]))
			return $this->array_request[$name];
		return null;
	}
	
	/**
	 * Método que pega o atributo do array passado pelo parâmetro
	 * 
	 * @param attr_name  Nome do atributo a ser setado
	 * @param object  Objeto que será colocado na requisição
	 */
	public function set(String $attr_name, $object){
		$this->array_request[$attr_name] = $object;
	}
	
	public function get_model_name(){
		return $this->model_name;
	}
	
	public function set_model_name($model_name){
		$this->model_name = $model_name;
	}
	
	public function get_action_name(){
		return $this->action_name;
	}
	
	public function set_action_name($action_name){
		$this->action_name = $action_name;
	}
	
	public function get_cookies(){
		return $this->cookies;
	}

	public function set_cookie($name_cookie, $value){
		$this->cookies[$name_cookie] = $value;
	}


}
?>