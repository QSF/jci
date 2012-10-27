<?php
/**
 * Controller que canaliza todas as requisições e despacha para a action apropiada
 * 
 * Front Controller é o controlador que recebe todas as requisições, manipula as entradas da requisição
 * e a partir delas, determina dinamicamente qual ação seguir.
 * 
 * Há duas soluções. Seguir o pattern Command e a partir dele 
 * cada ação do sistema teria uma classe com apenas um método.
 * O ponto fraco dessa abordagem é o resultado de muitas classes do sistema.
 * Exemplo: index.php?action=IntermediarDoações
 * 
 * A outra é separar o sistema pelos módulos e suas respectivas ações
 * Exemplo:index.php?model=doacao&action=intermediar
 * 
 * Por ora, foi escolhida a segunda abordagem
 * 
 * @link http://martinfowler.com/eaaCatalog/frontController.html
 * @access public
 */
 
 class FrontController{

	private $request;
	/**
	 * Inicializa as propriedades do front controller
	 * 
	 * Construtor que trata os atributos da requisicao, salvando nas variáveis de instância 
	 * o nome da classe e o nome da action dada
	 */	
	 public function __construct(Request $request){
	 	$this->request = $request;
	 }
	 
	 /**
	  * Despacha para as actions de acordo com os atributos da URL
	  * 
	  * O atributo model aponta para o controller em questão.
	  * O atributo action é o método dessa classe em questão
	  *
	  */
	 public function dispatch(){
		
		//ucfirst coloca a primeira letra da variável em caixa alta
		$controller_name = ucfirst($this->request->get_model_name());
		$action_name = $this->request->get_action_name();

		include $controller_name.'.php';
		
		$sucesso = false;
	
		if(class_exists($controller_name)){
			$controller_object = new $controller_name($this->request);

			if(method_exists($controller_object, $action_name)){		
				$controller_object->{$action_name}();
				$sucesso = true;
			}
		}
		
		if(! $sucesso){
			echo "URL Invalida";
		}
		
	}
 }
 

?>