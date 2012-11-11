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
		$user->setReceiveNotification ( $notification								      );
		$user->setName                ( $this->request->get('name')					      );
		$user->setEmail				  ( $this->request->get('email')					  );
		$password = $this->request->get('password');
		$changePassword = $this->request->get('changePassword');
		if ($changePassword == null)//Ou é cadastro, ou não selecionou que quer manter a senha.
			$password = md5($password);
		else
			$password = $this->request->get('oldPassword');//maior gambi, certo era ver a senha atual, ou mexer com js.
		
		$user->setPassword 			  ( 	$password									  );
		$user->setPhone				  ( $this->dropCharacter($this->request->get('phone')));
		$user->setHowYouKnow		  ( $this->request->get('howYouKnow')			      );
		$this->setPublicServed		  ( $user            							      );
		$this->setActingArea		  (	$user				 						      );
		$user->setCep 				  ( $this->dropCharacter($this->request->get('cep'))  );		
	}

	/**
	 *	Método que pega a lista de público, selecionada pelo usuário, da request.
	 *  E seta para o user passado como parametro.
	 *  @param $user usuário que receberá os valores
	 */
	protected function setPublicServed($user){
		$publics = $this->request->get('public');
		$dao = ServiceLocator::getInstance()->getDAO("DAO");
		foreach ($publics as $pid) {
			$public = new PublicServed;
			$public->setId($pid);
			$public = $dao->findById($public);
			if($public != null){
				$user->addPublic($public);
			}

		}
	}

	/**
	 *	Método que pega a lista de campos (área de atuação), selecionada pelo usuário, da request.
	 *  E seta para o user passado como parametro.
	 *  @param $user usuário que receberá os valores
	 */
	protected function setActingArea($user){
		$fields = $this->request->get('actingArea');
		$dao = ServiceLocator::getInstance()->getDAO("DAO");
		foreach ($fields as $fid) {
			$field = new Field;
			$field->setId($fid);
			$field = $dao->findById($field);
			if($field != null)
				$user->addArea($field);
		}
	}

	/** 
	*	Método que monta um user de acordo com os dados de legal person passados em uma requisição.
	*
	*	@param user usuário que receberá os valores dos campos de legal person
	*/
	protected function getLegalPerson($user){
		$this->getUser($user);
		$user->setCnpj 				( $this->dropCharacter($this->request->get('cnpj'))             );
		$user->setCompanyName 		( $this->request->get('companyName')		                    );
		$user->setStateRegistration ( $this->dropCharacter($this->request->get('stateRegistration')));
		$user->setOwnerPhone 		( $this->dropCharacter($this->request->get('ownerPhone'))       );
	}

	/** 
	*	Método que monta um user de acordo com os dados de natural person passados em uma requisição.
	*
	*	@param user usuário que receberá os valores dos campos de Natural person
	*/
	protected function getNaturalPerson($user){
		$this->getUser($user);
		$user->setCpf($this->dropCharacter($this->request->get('cpf')));
	}

	/** 
	*	Método que monta um user de acordo com os dados de voluntario passados em uma requisição.
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
		$date = date('Y-m-d', strtotime($this->request->get('establishmentDate')) );
		$user->setEstablishmentDate(new \DateTime($date));
		$user->setSite($this->request->get('site'));

		$situation =  $this->request->get('situation') != null ? true : false;
		$user->setSituation($situation);
		$user->setStatus(false);

		return $user;
	}

	/**
	*	@return user moderador
	*/
	public function getModerator(){
		$user = new Moderator;
		$user->setLogin($this->request->get("user_id"));
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

		$public->setName($name);

		return $public;
	}

	/**
	*	Método que retorna um publico na hora de atualizar.
	*	@return public.
	*/
	public function getUpdatePublic(){
		return $this->getPublic(true);
	}

	/**
	*	Método que retorna um publico na hora de criar.
	*	@return public.
	*/
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

	public function dropCharacter($attribute) {
		$attribute = str_replace("(", "", $attribute);
		$attribute = str_replace(")", "", $attribute);
		$attribute = str_replace("-", "", $attribute);
		$attribute = str_replace(".", "", $attribute);
		$attribute = str_replace("/", "", $attribute);
		$attribute = str_replace(" ", "", $attribute);
		return $attribute;
	}

	/**
	*	Método que retorna uma doação de um formulário.
	*	@return $donation.
	*	@return null caso os dados estejam incompletos.
	*/
	public function getDonation(){
		$donation = new Donation;
		$entity = new Entity;
		$volunteer = new VolunteerLegalPerson; //aqui pode ser qlq tipo de usuário, o ideal seria volunteer mais é abstrata

		$volunteerId = $this->request->get('id_voluntario');
		$volunteer->setId($volunteerId);
		$entityId = $this->request->get('id_entidade');
		$entity->setId($entityId);

		$dao = ServiceLocator::getInstance()->getDAO("DAO");
		$volunteer = $dao->findById($volunteer);

		if ($volunteer == null){//para saber qual tipo de Voluntário foi selecionado.
			$volunteer = new VolunteerNaturalPerson;
			$volunteer->setId($volunteerId);
			$volunteer = $dao->findById($volunteer);
		}

		$entity = $dao->findById($entity);

		$field = $this->getSingleField();
		$field = $dao->findById($field);

		$date = date('Y-m-d', strtotime($this->request->get('date')));
		$date = new \DateTime($date);

		$moreInfo = $this->request->get('moreInfo');

		if ($moreInfo === null)
			$moreInfo = "";

		if($field === null || $volunteer === null || $entity === null || $date === null){
			return null;
		}
		$donation->setField($field);
		$donation->setVolunteer($volunteer);
		$donation->setEntity($entity);
		$donation->setDate($date);
		$donation->setMoreInfo($moreInfo);

		return $donation;
	}
}

?>