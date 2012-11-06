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
			$this->view->assignError('Erro ao excluir, doação não existe!');
			//carregar no log de erros, com informações para o dev.
			$view->display("404");
			return;
		}

		$donation = new Donation();
		$donation->setId($donationId);
	
		$this->authorize($user);

		$donation = $this->dao->findById($donation);

		if ($donation === null){
			$this->view->assignError('Erro, doação não encontrado!');
			$this->view->display('Home');
			return;
		}
		
		if ($this->getUserPermission($donation)){//tem permissão de deletar
			$this->dao->delete($user);
			$this->view->assignSuccess("Doação deletado com sucesso!");
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

		$this->redirectCreate();
	}

	public function redirectManage(){
		$donationDAO = ServiceLocator::getInstance()->getDAO('DonationDAO');

		$donations = $donationDAO->findAll();

		$this->view->assign("donations",$donations);

		$this->view->display("DonationList");
	}

	public function update(){
		
		$donation = $this->request->getDonation();
		if ($donation === null){
			$this->view->assignError('Erro ao editar!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display("404");
			return;
		}
		$donation->setId($this->request->get("id_donation!"));
		$oldDonation = $this->dao->findById($donation);
		
		if ($this->getUserPermission($oldDonation)){
			//$this->dao->clear();
			$this->dao->update($donation);
			$this->view->assignSuccess("Doação editado!");	
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
}
?>