<?php 

require_once (DAO_PATH   . "/UserDAO.php");
require_once (DAO_PATH   . "/DAODoctrine.php");
require_once (MODEL_PATH . "/User.php");

use Doctrine\ORM\Query\ResultSetMapping;


/** Classe do DAO do usuário para o doctrine.
*	@see UsuarioDAO.
*/
class UserDAODoctrine extends DAODoctrine implements UserDAO{

	/** 
	*	Método que retorna o objeto equivalente à uma coluna do banco que possui o email passado.
	*
	*
	*	@param $email email do usuário que será procurado.
	*	@return object objeto referente a tupla com este email na tabela.
	*	@return null caso não tenha nenhuma tupla com este email.
	*
	*	@link http://docs.doctrine-project.org/en/2.0.x/reference/working-with-objects.html#by-simple-conditions
	*	@todo Jogar exceptions	
	*	@todo Se o doctrine deixar, colocar o latest como link.	
	*/
	public function findByEmail($email){
		$rsm = new ResultSetMapping;
		$rsm->addEntityResult('User', 'u');
		$rsm->addFieldResult('u', 'email', 'email');
		$rsm->addFieldResult('u', 'id', 'id');
		$rsm->addMetaResult('u', 'user_type', 'user_type'); //discriminator
		$rsm->setDiscriminatorColumn('u', 'user_type');

		$query = $this->entityManager->createNativeQuery('SELECT id,email,user_type FROM user WHERE email = ?', $rsm);
		$query->setParameter(1, $email);

		//pega o tipo do usuário e o seu id
		$result = $query->getResult();

		if ($result == null)//caso não tenha ninguém com este email, return null.
			return null;

		$this->entityManager->detach($result[0]);//tem que estar unmanaged para buscar completo.
		//o $result[0] é o objeto retornado.
		return  $this->findById($result[0]);
	}

	/** 
	*	Método que retorna o objeto equivalente à uma coluna do banco que possui o id passado.
	*
	*
	*	@param $id id do usuário que será procurado.
	*	@return object objeto referente a tupla com este id na tabela.
	*	@return null caso não tenha nenhuma tupla com este id.
	*
	*/
	public function findOneById($id){
		$rsm = new ResultSetMapping;
		$rsm->addEntityResult('User', 'u');
		$rsm->addFieldResult('u', 'id', 'id');
		$rsm->addMetaResult('u', 'user_type', 'user_type'); //discriminator
		$rsm->setDiscriminatorColumn('u', 'user_type');

		$query = $this->entityManager->createNativeQuery('SELECT id,user_type FROM user WHERE id = ?', $rsm);
		$query->setParameter(1, $id);

		//pega o tipo do usuário e o seu id
		$result = $query->getResult();

		if ($result == null)//caso não tenha ninguém com este email, return null.
			return null;

		$this->entityManager->detach($result[0]);//tem que estar unmanaged para buscar completo.
		//o $result[0] é o objeto retornado.
		return  $this->findById($result[0]);
	}

	protected function getRepository(){
		return $this->entityManager->getRepository('user');
	}

	public function search($searchWord, $attributeType, $positionResults, $maxResults){
		$dql = "SELECT u FROM user u WHERE u.". $attributeType ." LIKE '%$searchWord%' ORDER BY u.name";
		return $this->resultPaginated($dql, $positionResults, $maxResults, false);
	}

	public function getAllNotifiedUsers(){
		return $this->getRepository()->findBy(array('receiveNotification' => true));
	}

	public function getUsersByField($field){

		$query = $this->entityManager->createQuery('SELECT u FROM user u JOIN u.actingArea a WHERE a.id = '.$field->getId());
		$users = $query->getResult();
		return $users;
	}

	public function getUsersByUserField($user){

		$arrayFields = $user->getActingArea();

		$i = 0;

		$dql = 'SELECT u FROM user u JOIN u.actingArea a WHERE ';
		foreach($arrayFields as $field){
				$dql = $dql . 'a.id = ' . $field->getId();
				if($i < ( count($arrayFields) - 1 ) ){
					$dql = $dql . ' OR ';
				$i++;
				}
		}

		$query = $this->entityManager->createQuery($dql);
		
		$users = $query->getResult();
		return $users;
	}

	/**
	*	Método que buscas os usuários(de forma paginada) por um determinado publico passado de parâmetro.
	*
	*	@param $public publico no qual servirá de filtro.
	*	@return $users lista de usuário com este público.	
	*	@param $positionResults Posição inicial dos resultados.
	*	@param $maxResults Número máximo de resultados.
	*/
	public function findUsersByPublic($public, $positionResults, $maxResults){

		$dql = 'SELECT u FROM user u JOIN u.public a WHERE a.id = '. $public->getId();
		return $this->resultPaginated($dql, $positionResults, $maxResults, false);
	}
}
?>
