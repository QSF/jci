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
		
		//Significa que nao foi passado nenhum parametro.
		//Redirecionar para a home
		if($this->request->getControllerName() == null && $this->request->getActionName() == null){
			$urlName = PUBLIC_PATH."/index.php?controller=Registration&action=directDisplay&page=Home";
			$this->request->setControllerName("Registration");
			$this->request->setActionName("directDisplay");
			$this->request->set("page","Home");
		}
		//ucfirst coloca a primeira letra da variável em caixa alta
		$controllerName = ucfirst($this->request->getControllerName())."Controller";
		$actionName = $this->request->getActionName();

		try{
			include_once CONTROLLER_PATH.DIRECTORY_SEPARATOR.$controllerName.".php";
			
			if(class_exists($controllerName) ){
				$controllerObject = new $controllerName($this->request);

				if(method_exists($controllerObject, $actionName)){		
					$controllerObject->{$actionName}();
				}
				else{
					throw new Exception("Recurso nao encontrado");
				}
			}
			else{
				throw new Exception("Recurso nao encontrado");
			}
		}
		catch(Exception $e){
			//$this->view = ServiceLocator::getInstance()->getView('View');
			$view = new View();
			$view->setUserType($this->request->getUserType());
			$view->display("404");

			//echo $e->getMessage();
		}

		
	}
 }
 

?>