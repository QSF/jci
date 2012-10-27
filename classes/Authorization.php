<?php
/**
 * Gerencia a permissão dos recursos 
 *
 * Classe que checa se o usuário está autorizado a visualizar o recurso requisitado.
 * A ideia é ter em todas requisições o atributo user, que representará o papel do usuário.
 * <b>É necessário a atribuição do $_SESSION["role"] no momento do login</b>
 * 
 * Obs: O ponto fraco dessa abordagem é a necessidade de em todas as requisições ter o atributo "user"
 * O ponto forte é sua simplicidade
 * Ainda pode ser melhorado
 */

 
class Authorization{
	
	private $request;
	
	/**
	 * Construtor da classe Authorization
	 * 
	 * @param Request request
	 */
	public function __construct(Request $request){
		$this->request = $request;
	}
	
	/**
	 * Método que retorna o papel do usuário do site
	 * 
	 * @return string Nome do cargo 
	 */
	public function get_user_role(){

		
		//Checando se o usuário está autenticado no nosso sistema
		//Se não estiver, significa que é um visitante
		if(!isset($_SESSION["role"])){
			$role_user = "visitante";
		}
		else{
			$role_user = $_SESSION["role"];
		}
		
		return $role_user;
	}
	
	/**
	 * Método que pega o atributo da requisição
	 * 
	 * @return string retorna o papel que se encontra no atributo
	 */
	public function get_role_attribute(){
		$role_attribute = $_GET["user"];
	}
	
	/**
	 * 
	 * 
	 */
	public function authorizate(){
		
		$user_role = $this->get_user_role();
		
		echo $this->request->get("user");
		if(!isset($_GET["user"]))
			$user_role = "visitante";
		else
			$user_role = $_GET["user"];
		
		
		if(! isset($user_role) && !(strcmp($user_role, "visitante"))){
			
		}
	}
}
?>
