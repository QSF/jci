<?php 

/*Inclue as classes que possuem o factory. Precisa ver o melhor lugar para deixar os factorys*/
require_once ("factorys/ViewFactory.php");
require_once (CLASSES_PATH . "factorys/ViewFactory.php");


/** Classe responsável por instanciar nossos recursos.
*
* Toda parte de instanciar objetos importantes ao nosso sistema serão encapsulados aqui.
* Ela ainda mantém um chace, para se caso for preciso, reaproveitar um instancia.
* Aqui são instanciados:
*			DAO  - utilizar um DAOFactory, passado por parâmetro em algum xml.
*			View - Podendo utilizar também uma simples factory.
* 
*/
class ServiceLocator
{
	/** Variável que mantem um conjunto de objetos que criam recursos.
	*
	* Possui um array de todos os objetos que vão criar os recursos de nosso sistema, desta forma a dependência é passada para eles.
	* Neste array, vão haver basicamente factorys, tanto pada DAO, View e o que mais tiver.
	*
	* @see ResourceRegisters Esta variável é deste tipo.  
	*/
	private $resourceRegisters;
	/** Um objeto que possui um array de recursos utilizado para fazer cache.
	*	
	* Um objeto do tipo Cache que manteém um array dos recursos instanciados, desta forma é possível fazer chace e evitar retrabalho.
	*
	* @see Cache
	*/
	private $cache;

	private static $instance;
	
	function __construct()
	{
		$this->resourceRegisters = new ResourceRegisters;
		$this->cache = new Cache();
		$this->init();
	}

	/** Métod que inicializa os registers.
	*
	*	@todo ler as configurações de um arquivo xml, onde o nome do mesmo será dado pelo arquivo config.php.
	*/
	public function init(){
		//le de um xml(nome do arquivo no config.php)
		//instancia as factorys
		$this->resourceRegisters->add('View', new ViewFactory());
	}

	/** Método que pegamos uma instância do nosso service locator.
	* @return instância do ServiceLocator
	*/
	public static function getInstance(){
		if ( self::$instance == null ){
			self::$instance = new ServiceLocator();
		}

		return self::$instance;
	}

	/** Método que pega a instância de um DAO.
	* @param $name nome do DAO desejado.
	*
	* @return instância do DAO - se conseguir criar.
	* @return null, caso não consiga criar.
	*
	* @todo padronizar este nomes que serão passados.
	*/
	public function getDAO($name){
		//pega a variável da cache.
		$resource = $this->cache->get($name);

		if ($resource === null){//não tem na cache
			//isso precisa ser feito de uma maneira melhor.
			$register = $this->resourceRegisters->get('DAOFactory');
			if ($register === null){//new execption
				return null;
			}
			$register->create($name);//cria o DAO com a factory.
			$cache->add($name,$resource);
		}
		return $resource;
	}

	/** Retorna a instância de uma View
	* @param $name nome da view.
	*
	* @return instância da view.
	* @return null, caso não consiga criar.
	*
	* @todo padronizar este nomes que serão passados.
	*/
	public function getView($name){
		//pega a variável da cache.
		$resource = $this->cache->get($name);

		if ($resource === null){//não tem na cache
			//isso precisa ser feito de uma maneira melhor.
			$register = $this->resourceRegisters->get('View');
			if ($register === null){//new execption
				return null;
			}
			$resource = $register->create($name);//cria a view com a factory.
			$cache->add($name,$resource);
		}
		return $resource;
	}

	//criar um método que receba o nome do registro, já que getView e getDAO são cópias.
}
?>