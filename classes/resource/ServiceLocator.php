<?php 

/*Inclue as classes que possuem o factory. Precisa ver o melhor lugar para deixar os factorys*/
require_once (REGISTERS_PATH . "/ViewFactory.php");
require_once (REGISTERS_PATH . "/DAODoctrineFactory.php");
require_once (RESOURCE_PATH  . "/ResourceRegisters.php");
require_once (RESOURCE_PATH  . "/Cache.php");


/** Classe responsável por instanciar nossos recursos.
*
* Toda parte de instanciar objetos importantes ao nosso sistema serão encapsulados aqui.
* Ela ainda mantém um chace, para se caso for preciso, reaproveitar uma instancia(de um resource).
* Além disso, para criar esses resources, a classe ResourceRegisters(array de ResourceRegisters) é utilizada.
* Aqui são instanciados:
*			DAO  - utilizar um DAOFactory, passado por parâmetro em algum xml.
*			View - Podendo utilizar também uma simples factory.
* Está classe é SingleTon e para acessá-la utiliza o método ServiceLocator::getInstance()
* Lembre-se que registros criam resources.
*
* @see ResourceRegisters 
* @see Register
* @see Cache 
* @todo Adicionar o xml para pegar os nossos registers. 
* 
*/
class ServiceLocator
{
	/** Variável que mantem um conjunto de objetos que criam recursos.
	*
	* Possui um array de todos os objetos que vão criar os recursos de nosso sistema, desta forma a dependência é passada para eles.
	* Neste array, vão haver basicamente factorys, tanto pada DAO, View e o que mais tiver.
	*
	* @var ResourceRegisters 
	* @see ResourceRegisters Esta variável é deste tipo.  
	*/
	private $resourceRegisters;
	/** Um objeto que possui um array de recursos utilizado para fazer cache.
	*	
	* Um objeto do tipo Cache que manteém um array dos recursos instanciados, desta forma é possível fazer chace e evitar retrabalho.
	* @var Cache
	* @see Cache
	*/
	private $cache;


	/**
	* @var ServiceLocator
	*/
	private static $instance;
	
	function __construct()
	{
		$this->resourceRegisters = new ResourceRegisters;
		$this->cache = new Cache;
		$this->init();
	}

	/** Métod que inicializa os registers.
	*
	*	@todo ler as configurações de um arquivo xml, onde o nome do mesmo será dado pelo arquivo config.php.
	*/
	public function init(){
		//le de um xml(nome do arquivo no config.php)
		//instancia as factorys
		$this->resourceRegisters->add('DAO', new DAODoctrineFactory());
		$this->resourceRegisters->add('View', new ViewFactory());
	}

	/** Método que pegamos uma instância do nosso service locator.
	* @return serviceLocator instância do ServiceLocator
	*/
	public static function getInstance(){
		if ( self::$instance == null ){
			self::$instance = new ServiceLocator();
		}

		return self::$instance;
	}

	/** Método geral de criar um resource, para evitar crtl c e crtl v(é command jonas? rsrs)
	* @param $name nome do resource desejado.
	* @param $registerName nome do register que criará o resource.
	*
	* @return resource um resource - se conseguir criar.
	* @return null caso não consiga criar.
	*
	* @throws Exception - Se não houver register com este nome.
	*
	* @todo utilizar um padrão para os nomes(como lowercase).
	*/
	private function getResource($name,$registerName){
		//pega a variável da cache.
		$resource = $this->cache->get($name);

		if ($resource === null){//não tem na cache
			$register = $this->resourceRegisters->get($registerName);

			if ($register === null)//new execption
				throw new Exception("ServiceLocator:Erro - Register " . $registerName . " não encontrado! ");

			$resource = $register->create($name);//cria o resource(a factory tem que possuir este método :/)

			if ($resource === null)//verificar de criou corretamente
				return null;
			//se sim, adiciona para a cache
			$this->cache->add($name,$resource);
		}
		return $resource;
	}

	/** Método que pega a instância de um DAO.
	* @param $name nome do DAO desejado.
	*
	* @return dao instância do DAO - se conseguir criar.
	* @return null caso não consiga criar.
	*
	* @todo padronizar este nomes que serão passados.
	*/
	public function getDAO($name){
		return $this->getResource($name,'DAO');
	}

	/** Retorna a instância de uma View
	* @param $name nome da view.
	*
	* @return view instância da view.
	* @return null caso não consiga criar.
	*
	* @todo padronizar este nomes que serão passados.
	*/
	public function getView($name){
		return $this->getResource($name,'View');
	}
}
?>