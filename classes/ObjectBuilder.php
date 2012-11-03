<?php 
//esses includes ...
require_once MODEL_PATH . "/Volunteer.php";
require_once MODEL_PATH . "/Entity.php";
require_once MODEL_PATH . "/VolunteerLegalPerson.php";
require_once MODEL_PATH . "/VolunteerNaturalPerson.php";
require_once MODEL_PATH . "/Moderator.php";
require_once MODEL_PATH . "/Administrator.php";

/** Classe que constrói um usuário(qualquer tipo) a partir de uma Request.
*
*	Está classe é utilizada para passar os dados de uma request para um objeto de um usuário.
*	Desta forma, ela seria usada para pegar dados de fomulário de cadastro, edição, etc. 
*	@see Request::getUser()
*/

class ObjectBuilder
{	
	protected $request;

	function __construct($request){
		$this->request = $request;
	}

	/** Método que monta o público atendido, convertendo os checkboxs para string
	*
	*	@return $str string com os públicos atendidos
	*/
	protected function getPublic(){
		$str = '';
		//retorna um array das checkbox
		$public = $this->request->get('public');
		if ($public === null)
			return $str;
		
		//Transforma um array em uma sequencia de strings separada por uma virgula
        $str = implode(',',$public);

        return $str;
	}

	/** Método que monta um User de acordo com os dados passados em uma requisição.
	*
	*	Este método é uma generalização para pegar os dados de todos os tipos de usuário.
	*
	*	@param $user usuário que receberá os valores
	*
	*	@todo implementar field
	*/
	protected function getUser($user){
		$notification = $this->request->get('receivedNotification') == null ? false : true;
		$user->setReceiveNotification ( $notification						);
		$user->setName                ( $this->request->get('name')			);
		$user->setEmail				  ( $this->request->get('email')		);
		$user->setPassword 			  ( md5($this->request->get('password')));
		$user->setPhone				  ( $this->request->get('phone')		);
		$user->setHowYouKnow		  ( $this->request->get('howYouKnow')	);
		$user->setPublic			  ( $this->getPublic() 					);
		//temos que implementar o field
		$user->setCep 				  ( $this->request->get('cep')			);		
	}

	/** Método que monta um user de acordo com os dados de legal person passados em uma requisição.
	*
	*	@param user usuário que receberá os valores dos campos de legal person
	*/
	protected function getLegalPerson($user){
		$this->getUser($user);
		$user->setCnpj 				( $this->request->get('cnpj')				);
		$user->setCompanyName 		( $this->request->get('companyName')		);
		$user->setStateRegistration ( $this->request->get('stateRegistration')	);
		$user->setOwnerPhone 		( $this->request->get('ownerPhone')			);
	}

	/** Método que monta um user de acordo com os dados de natural person passados em uma requisição.
	*
	*	@param user usuário que receberá os valores dos campos de Natural person
	*/
	protected function getNaturalPerson($user){
		$this->getUser($user);
		$user->setCpf($this->request->get('cpf'));
	}

	/** Método que monta um user de acordo com os dados de voluntario passados em uma requisição.
	*
	*	@param user usuário que receberá os valores dos campos de volunteer
	*/
	protected function getVolunteer($user){
		$user->setExperience($this->request->get('experience'));
	}

	/**
	*	@return user volunteerLegalPerson
	*/
	public function getVolunteerLegalPerson(){
		$user = new VolunteerLegalPerson;
		
		$this->getLegalPerson($user);
		$this->getVolunteer($user);

		return $user;
	}

	/**
	*	@return user volunteerNaturalPerson
	*/
	public function getVolunteerNaturalPerson(){
		$user = new VolunteerNaturalPerson;
		
		$this->getNaturalPerson($user);
		$this->getVolunteer($user);

		return $user;	
	}

	/**
	*	@return user entity
	*	@todo ver o os valores default de status e situation
	*/
	public function getEntity(){
		$user = new Entity;
		$this->getLegalPerson($user);
		$this->getUser($user);
		$user->setEstablishmentDate(new \DateTime($this->request->get('establishmentDate')));
		$user->setSite($this->request->get('site'));
		
		//por default, a situação e status é false?
		$user->setStatus(false);
		$user->setSituation(false);

		$receivedNotification = $this->request->get('receivedNewsletter') != null ? true : false;
		$user->setNewsletter($receivedNotification);
		return $user;
	}

	/**
	*	@return user moderador
	*/
	public function getModerator(){
		$user = new Moderator;
		
		$user->setLogin($this->request->get("login"));
		$user->setPassword(md5($this->request->get("password")));
		$user->setEmail($this->request->get("email"));

		return $user;
	}

	/** 
	*	Método que pega o field que possui pai(ou é macro).
	*	@param $update se é ação update, ou seja, para saber se procura o id ou não.
	*	@return field campo(apenas o id).
	*	@return null caso nada seja passado.
	*/
	protected function getField($update){
		$parent = null;

		$parentId = $this->request->get("id");

		if ($parentId === null)//não existe
			return null;

		if ($parentId != 'macro'){//este campo não é macro
			$parent = new Field;
			$parent->setId($parentId);
		}

		$field = new Field;
		$id = -1;

		if ($update == true){//é atualizar
			$id = $this->request->get("field_id");

			if ($id === null)
				return null;
		}

		$field->setId($id);

		$name = $this->request->get("name");

		if ($name === null)//o valor não foi passado.
			return null;

		$field->setName($name);
		$field->setParent($parent);

		return $field;
	}

	/** 
	*	Método que pega o field que possui pai(ou é macro) para update.
	*	@return field campo(apenas o id).
	*	@return null caso nada seja passado.
	*/
	public function getUpdateField(){
		return $this->getField(true);
	}

	/** 
	*	Método que pega o field que possui pai(ou é macro) para create.
	*	@return field campo(apenas o id).
	*	@return null caso nada seja passado.
	*/
	public function getCreateField(){
		return $this->getField(false);
	}

	/** 
	*	Pega o field cujo nome estará id(no caso de excluir).
	*	@return field campo(apenas o id).
	*	@return null caso nada seja passado ou o campo selecionado for o macro.
	*/
	public function getSingleField(){
		$field = new Field;
		$id = $this->request->get("id");
		if ($id === null || $id == 'macro')//não existe
			return null;

		$field->setId($id);

		return $field;
	}

	/** 
	*	@param $update se é ação update, ou seja, para saber se procura o id ou não.
	*	@return public publico.
	*	@return null caso nada o nome não seja passadou(ou o id, em caso de $update = true).
	*/
	protected function getPublic($update){
		$public = new PublicServed;

		$id = -1;

		if ($update == true){
			$id = $this->request->get("id");

			if ($id === null)//não existe
				return null;
		}
		$public->setId($id);
		$name = $this->request->get('name');

		if ($name === null)//o valor não foi passado.
			return null;

		$field->setName($name);

		return $public;
	}

	public function getUpdatePublic(){
		return $this->getPublic(true);
	}

	public function getCreatePublic(){
		return $this->getPublic(false);
	}

	/** 
	*	@return public publico.
	*	@return null caso nada seja passado(ou o id não seja passado).
	*/
	public function getSinglePublic(){
		$public = new PublicServed;

		$id = $this->request->get("id");

		if ($id === null)//não existe
			return null;

		$public->setId($id);

		return $public;
	}
}

?>