<?php

class DonationController extends ApplicationController{

	/** 
	* Dao que realiza o crud que nossas classes irão usar
	*/
	private $dao;

	public function __construct(Request $request){
		parent::__construct($request);	
		$this->dao = ServiceLocator::getInstance()->getDAO("DAO");
	}

	public function delete(){
		$donationId = $this->request->get("id_donation");

		if ($donationId === null){
			$this->view->assignError('Erro ao remover, doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$donation = new Donation();
		$donation->setId($donationId);

		$donation = $this->dao->findById($donation);

		if ($donation === null){
			$this->view->assignError('Erro, doação não encontrada!');
			$this->view->display('Home');
			return;
		}
		
		if ($this->getUserPermission($donation)){//tem permissão de deletar
			$this->dao->delete($donation);
			$this->view->assignSuccess("Doação removida com sucesso!");
		}else {
			$this->view->assignError('Erro, permissão negada!');
		}
		$this->display("Home");
	}

	/** 
	* Carrega lista de campos e público e redireciona para página de cadastro.
	*/
	public function redirectCreate(){

		$volunteerDao = ServiceLocator::getInstance()->getDAO("VolunteerDAO");
		$volunteers = $volunteerDao->findAll();
		$this->view->assign("volunteers", $volunteers);

		$entityDao = ServiceLocator::getInstance()->getDAO("EntityDAO");
		$entities = $entityDao->findAllEntitiesApproved();//deve pegar apenas as entidade aprovadas
		$this->view->assign("entities",$entities);

		$fieldDao = ServiceLocator::getInstance()->getDAO("FieldDAO");
		$fields = $fieldDao->findAllMacros();//pega todos os campos macros
		$this->view->assign("fields", $fields);

		$page = 'DonationForm';
		$this->view->display($page);
	}


	public function authorize($user){
		//Futuramente terá autorizacao
		//To pensando em fazer por sql
	}

	public function create(){
		$donation = $this->request->getDonation();
		if ($donation === null){
			$this->view->assignError('Doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}
		$loggedUser = $this->request->getUserSession();
		$loggedUser = $this->dao->findById($loggedUser);
		$donation->setModerator($loggedUser);
		
		$this->dao->insert($donation);

		$this->view->assignSuccess("Doação registrada com sucesso!");
		$this->display("Home");
	}

	public function redirectUpdate(){
		$donation = new Donation;
		$donationId = $this->request->get('id_donation');
		if($donationId === null){
			$this->view->assignError('Doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}
		$donation->setId($donationId);
		$donation = $this->dao->findById($donation);
		if($donation === null){
			$this->view->assignError('Doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$this->view->assign("donation",$donation);
		//Tem que arrumar a parte de listar para poder exibir o campo existente.
		$this->view->assign("field",$donation->getField());
		$this->view->assign("action","update");

		$this->redirectCreate();
	}

	public function redirectManage(){
		$page = $this->getPage("page");

		$pagePosition = $page * $this->maxResults;

		$donationDAO = ServiceLocator::getInstance()->getDAO('DonationDAO');
		//procura de acordo com a paginação.
		$donations = $donationDAO->findDonations($pagePosition, $this->maxResults);

		$this->assignPagination($page, $donations, null);

		$this->view->assign("donations",$donations);
		$this->view->assign("isModerator",$this->isModerator());//verifica se é moderador.

		$this->view->display("DonationList");
	}

	/**
	*	Método que exibi a lista de doações de um usuário.
	*/
	protected function redirectDonations($id){
		$page = $this->getPage("page");

		$pagePosition = $page * $this->maxResults;

		if ($id === null){
			$this->view->assignError('Usuário não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$userDao = ServiceLocator::getInstance()->getDAO('UserDAO');

		$user = $userDao->findOneById($id);

		if ($user === null){
			$user = new Moderator;
			$user->setId($id);
			$user = $this->dao->findById($user);			

			if ($user === null){
				$this->view->assignError('Usuário não existe!');
				//carregar no log de erros, com informações para o dev.
				$this->view->display("404");
				return;
			}
		}
		//pegar apenas uma parte, sendo que a ordem é invertida
		$donations = array_slice(array_reverse($user->getDonations()), $pagePosition, $this->maxResults) ;
		
		$this->assignPagination($page, $user->getDonations(), null);

		$this->view->assign("donations",$donations);
		$this->view->assign("userId",$user->getId());

		$this->view->assign("isModerator",$this->isModerator());//verifica se é moderador.

		$this->view->display("DonationList");
	}

	/**
	*	Lista todas as doações do usuário logado
	*	@see self::redirectDonations.
	*/
	public function redirectLoggedUserDonations(){
		$this->redirectDonations($this->request->getUserSession()->getId());
	}

	/**
	*	Lista todas as doações que o usuário participa.
	*	@see self::redirectDonations.
	*/
	public function redirectUserDonations(){
		$userId = $this->request->get("user_id");

		if ($userId === null){
			$this->view->assignError('Usuário não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$this->redirectDonations($userId);
	}

	/**
	*	Lista todas as doações que é feita com este campo, ou seu campo pai.
	*/
	public function redirectFieldDonations(){
		$page = $this->getPage("page");

		$pagePosition = $page * $this->maxResults;

		$fieldId = $this->request->get("id");

		if ($fieldId === null){
			$this->view->assignError('Campo não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$field = new Field;
		$field->setId($fieldId);

		$field = $this->dao->findById($field);
		if ($field == null){
			$this->view->assignError('Campo não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;	
		}

		$donationDAO = ServiceLocator::getInstance()->getDAO('DonationDAO');
		//procura de acordo com a paginação.
		$donations = $donationDAO->findByField($field);
		$donations = array_reverse($donations);

		if ($this->request->get('listParent') != null){//lista os pais
			while ($field->getParent() != null){
				$field = $field->getParent();
				foreach (array_reverse($donationDAO->findByField($field)) as $donation) {
					array_push($donations,  $donation);
				}
			}
		}
		$donations = array_slice($donations, $pagePosition, $this->maxResults) ;
		$this->assignPagination($page, $donations, null);

		$this->view->assign("donations",$donations);
		$this->view->assign("isModerator",$this->isModerator());//verifica se é moderador.

		$this->view->display("DonationList");
	}

	/**
	*	Redireciona para uma página de busca de doações por entidade
	*/
	public function redirectSearchEntity(){
		$entityDao = ServiceLocator::getInstance()->getDAO("EntityDAO");
		$entities = $entityDao->findAllEntitiesApproved();//deve pegar apenas as entidade aprovadas

		$this->view->assign("users",$entities);

		$user = new Entity;
		$this->view->assign("user",$user);

		$page = 'DonationSearchUser';
		$this->view->display($page);
	}

	/**
	*	Redireciona para uma página de busca de doações por voluntário 
	*/
	public function redirectSearchVolunteer(){
		$volunteerDao = ServiceLocator::getInstance()->getDAO("VolunteerDAO");
		$volunteers = $volunteerDao->findAll();

		$this->view->assign("users", $volunteers);

		$user = new Entity;
		$this->view->assign("user",$user);

		$page = 'DonationSearchUser';
		$this->view->display($page);
	}

	/**
	*	Redireciona para uma página de busca de doações por campo(área de atuação)
	*/
	public function redirectSearchField(){
		$fieldDao = ServiceLocator::getInstance()->getDAO("FieldDAO");
		$fields = $fieldDao->findAllMacros();//pega todos os campos macros
		$this->view->assign("fields", $fields);

		$page = 'DonationSearchField';
		$this->view->display($page);
	}

	/**
	*	Método que exibi a lista de doações de um usuário não realizou feedback.
	*/
	protected function redirectFeedBacks($id){
		$page = $this->getPage("page");

		$pagePosition = $page * $this->maxResults;

		if ($id === null){
			$this->view->assignError('Usuário não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$userDao = ServiceLocator::getInstance()->getDAO('UserDAO');

		$user = $userDao->findOneById($id);


		if ($user === null){
			$this->view->assignError('Usuário não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$userType = get_class($user);

		if(strpos($userType,"Volunteer") !== false){
			$userType = 'Volunteer';
		}

		$donations = array();
		$method = 'getFeedBack' . $userType;

		foreach ($user->getDonations() as $donation)
			if ($donation->{$method}() === null)//somente as doações que não possuem feedbacks.
				array_push($donations, $donation);

		//pegar apenas uma parte, sendo que a ordem é invertida
		$donations = array_slice(array_reverse($donations), $pagePosition, $this->maxResults);
		
		$this->assignPagination($page, $user->getDonations(), null);

		$this->view->assign("donations",$donations);
		$this->view->assign("userId",$user->getId());

		$this->view->assign("isModerator",$this->isModerator());//verifica se é moderador.

		$this->view->display("DonationList");
	}

	/**
	*	Lista todas as doações que o usuário logado participa e que ainda não fez o feedback.
	*	@see self::redirectFeedBacks.
	*/
	public function redirectLoggedUserFeedBack(){
		$this->redirectFeedBacks($this->request->getUserSession()->getId());
	}

	/**
	*	Lista todas as doações que o usuário participa e que ainda não fez o feedback.
	*	@see self::redirectFeedBacks.
	*/
	public function redirectUserFeedBack(){
		$userId = $this->request->get("user_id");

		if ($userId === null){
			$this->view->assignError('Usuário não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$this->redirectFeedBacks($userId);
	}

	/**
	*	@return true se o usuário logado é moderador.
	*	@return false caso contrário.
	*/
	protected function isModerator(){
		return $this->request->getUserType() == 'Moderator';
	}

	/**
	*	Método que atualiza uma doação.
	*/
	public function update(){
		
		$donation = $this->request->getDonation();
		if ($donation === null){
			$this->view->assignError('Erro ao editar!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$donation->setId($this->request->get("id_donation"));
		$oldDonation = $this->dao->findById($donation);

		if ($this->getUserPermission($oldDonation)){
			//$this->dao->clear();
			$loggedUser = $this->request->getUserSession();
			$loggedUser = $this->dao->findById($loggedUser);
			$donation->setModerator($loggedUser);
			$this->dao->update($donation);
			$this->view->assignSuccess("Doação editada com sucesso!");	
		}else {
			$this->view->assignError("Falha de permissão!");	
		}
		
		$this->display("Home");
	}

	protected function getUserPermission($donation){
		//pega o usuário da sessão
		$loggedUser = $this->request->getUserSession();
		return $loggedUser->getId() == $donation->getModerator()->getId();
	}

	/**
	*	Redireciona para uma página que realiza um feeedBack
	*/
	public function redirectFeedBack(){
		//carrega a doação da URL
		$donationId = $this->request->get('id_donation');

		if($donationId === null){
			$this->view->assignError('Doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}
		$donation = new Donation;
		$donation->setId($donationId);
		$donation = $this->dao->findById($donation);

		if($donation === null){
			$this->view->assignError('Doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		//pega o feedback de acordo com o tipo usuário (entidade ou Voluntário).
		$userType = $this->request->getUserType();

		if(strpos($userType,"Volunteer") !== false){
			$userType = 'Volunteer';
		}
		$method = 'getFeedBack' . $userType;
		$feedBack = $donation->{$method}();

		//pega a doação(pela url) e o feedback(session)
		//carrega a doação e o feedback(de acordo com a session) que será 'editado'
		$this->view->assign("donation",$donation);
		$this->view->assign("feedBack",$feedBack);

		$this->view->display("FeedBackForm");
	}

	/**
	*	Método que realiza um feedback.
	*/
	public function doFeedBack(){
		//carrega a doação da URL
		$donationId = $this->request->get('id_donation');

		if($donationId === null){
			$this->view->assignError('Doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$donation = new Donation;
		$donation->setId($donationId);
		$donation = $this->dao->findById($donation);

		if($donation === null){
			$this->view->assignError('Doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		$feedBack = $this->request->get('feedBack');

		if($feedBack === null){
			$this->view->assignError('Erro ao realizar o feedBack!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}

		//seta o feedback de acordo com o tipo usuário (entidade ou Voluntário).
		$userType = $this->request->getUserType();

		if(strpos($userType,"Volunteer") !== false){
			$userType = 'Volunteer';
		}
		$method = 'setFeedBack' . $userType;
		$donation->{$method}($feedBack);

		//atualiza a doação com o novo feedBack.
		$this->dao->update($donation);
		$this->view->assignSuccess("Feedback realizado com sucesso!");	

		$this->view->display("Home");
	}

}
?>