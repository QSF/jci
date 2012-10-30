<?php 
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once (DAO_PATH . "/DAO.php");

/** Classe geral do DAO utiliando o ORM doctrine.
* Nesta classe, tudo que poder ser generalizado no nosso dao vai ser colocado aqui.
* O ORM Doctrine é utilizado aqui.
* Uma observação importante é sobre o escopo de gerência do entity manager, aqui nenhum destes escopos são tratados.
* @link https://doctrine-orm.readthedocs.org/en/latest/reference/working-with-objects.html#entity-state
*
*/
class DAODoctrine implements DAO{

	protected $entityManager;

	function __construct()
 	{
 		$this->initEntityManager();
 	}

 	/** Método que instancia um entity manager.
	*	Baseado na configuração geral do bd(database-config.php) o entity manger é criado.
	*	@see config/database-config.php
	*/
 	protected function initEntityManager(){
 		//variável globais de configuração do bd definidas no arquivo config/database-config.php
 		global $paths;
		global $isDevMode;
		global $dbParams;

		$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
		//cria um entity manager
		$this->entityManager = EntityManager::create($dbParams, $config);
 	}

	/** Método que persiste um objeto no banco.
	*	Este método dá um persiste e depois faz o flush, apenas isso.
	*	É necessário tomar cuidado com as entidades gerenciadas pelo entity manager.
	*	@param $object objeto a ser persistido.
	*/
	public function insert($object){
		$this->entityManager->persist($object);
		$this->entityManager->flush();
	}

	/** Método que deleta uma tupla da tabela de acordo com o objeto passado por parâmetro.
	*	Executa o EntityManage::remove() e depois faz o flush.
	*	É necessário tomar cuidado com as entidades gerenciadas pelo entity manager.
	*	@param $object objeto que contém o id(chave primária) da tupla que será buscada.
	*/
	public function delete($object){
		$this->entityManager->remove($object);
		$this->entityManager->flush();
	}

	/** Método que atualiza um objeto no banco.
	* 	O método merge é utilizado para atualizar o objeto no banco de dados, depois o flush é chamado.
	*
	*	É necessário tomar cuidado com as entidades gerenciadas pelo entity manager.
	*	@param $object objeto a ser atualizado.
	*/
	public function update($object){
		$this->entityManager->merge($object);
		$this->entityManager->flush();
	}

	/** Método que retorna o objeto equivalente à uma coluna do banco que possui o id passado.
	*
	*	É necessário tomar cuidado com as entidades gerenciadas pelo entity manager.
	*
	*	@param $id id(chave primária) da tupla que será buscada.
	*	@return object objeto referente a tupla com este id na tabela.
	*	@return null caso não tenha nenhuma tupla com este id.
	*
	*/
	public function findById($object){
		return $this->entityManager->find(get_class($object),$object->getId());
	}
}
?>