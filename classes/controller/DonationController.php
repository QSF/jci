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
			$view->display("404");
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
		$entities = $entityDao->findAll();
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
			$view->display("404");
			return;
		}
		$donation->setId($donationId);
		$donation = $this->dao->findById($donation);
		if($donation === null){
			$this->view->assignError('Doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$view->display("404");
			return;
		}

		$this->view->assign("donation",$donation);
		$this->view->assign("action","update");

		$this->redirectCreate();
	}

	public function redirectManage(){
		$donationDAO = ServiceLocator::getInstance()->getDAO('DonationDAO');

		$donations = $donationDAO->findAll();

		$this->view->assign("donations",$donations);
		$this->view->assign("isModerator",true);//é moderador.

		$this->view->display("DonationList");
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
	*	Método que exibi a lista de doações de um usuário.
	*/
	protected function redirectUserDonations($user){
		if ($user === null){
			$this->view->assignError('Usuário não existe!');
			//carregar no log de erros, com informações para o dev.
			$view->display("404");
			return;
		}

		$user = $this->dao->findById($user);
		$donations = $user->getDonations();

		$this->view->assign("donations",$donations);

		$this->view->assign("isModerator",$this->isModerator());//é moderador.

		$this->view->display("DonationList");
	}

	/**
	*	Lista todas as doações do usuário logado
	*	@see self::redirectUserDonations.
	*/
	public function redirectLoggedUserDonations(){
		$this->redirectUserDonations($this->request->getUserSession());
	}

	/**
	*	@return true se o usuário logado é moderador.
	*	@return false caso contrário.
	*/
	protected function isModerator(){
		return !($this->request->getUserType() != 'Moderador');
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
			$view->display("404");
			return;
		}
		$donation = new Donation;
		$donation->setId($donationId);
		$donation = $this->dao->findById($donation);

		if($donation === null){
			$this->view->assignError('Doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$view->display("404");
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
			$view->display("404");
			return;
		}

		$donation = new Donation;
		$donation->setId($donationId);
		$donation = $this->dao->findById($donation);

		if($donation === null){
			$this->view->assignError('Doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$view->display("404");
			return;
		}

		$feedBack = $this->request->get('feedBack');

		if($feedBack === null){
			$this->view->assignError('Erro ao realizar o feedBack!');
			//carregar no log de erros, com informações para o dev.
			$view->display("404");
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