<?php

/** 
 *  Controller responsável pelas ações sobre os publicos atendidos.
 * 	Basicamente o CRUD e a parte de redirecionar para páginas específicas.
 *	@todo fazer uma paginação quando for exibir.
 *  @todo verificar unique do nome.
 *	@todo fazer um erro mais geral.
 */
class PublicController extends ApplicationController{

	private $dao;

	public function __construct(Request $request){
		parent::__construct($request);	
		$this->dao = ServiceLocator::getInstance()->getDAO("PublicServedDAO");
	}

	
	/** 
	* Método que cria um novo publico atendido.
	*/
	public function create(){
		$public = $this->request->getPublic();

		if ($public === null){
			$this->view->assignError('O publico não existe!');
			$this->redirectManage();
			return;
		}

		$this->dao->insert($public);
		$this->view->assignSuccess('Publico ' . $public->getName() . ' criado com sucesso.');

		$this->redirectManage();
	}

	/** 
	* 	Método que atualiza um determinado public.
	*/
	public function update(){
		$public = $this->request->getPublic();

		if ($public === null){
			$this->view->assignError('O publico não existe!');
			$this->redirectManage();
			return;
		}
		
		$this->dao->update($public);

		$this->view->assignSuccess('O público ' . $public->getName() . ' foi editado com sucesso!');
		$this->redirectManage();
	}

	/** 
	* Método que remove um publico atendido.
	*/
	public function delete(){
		$public = $this->request->getPublic();

		if ($public === null){
			$this->view->assignError('O publico não existe!');
			$this->redirectManage();
			return;
		}

		try{
			$this->dao->delete($public);
			$this->view->assignSuccess('O publico' . $public->getName() . 'foi removido com sucesso!');
		} catch(Exception $e){//pegar a exception exata se há ou não usuário ou doação com este campo
	    	$this->view->assignError('O publico não pode ser removido!');
	    }	
	    $this->redirectManage();
	}

	/** 
	* Redireciona para a página específica de editar um publico.
	* Os valores atuais do publico serão carregados.
	*/
	public function redirectUpdate(){
		$public = $this->request->getPublic();

		if ($public === null){
			$this->view->assignError('O publico não existe!');
			$this->redirectManage();
			return;
		}
		
		$public = $this->dao->findById($public);

		if ($public === null){
			$this->view->assignError('O publico não existe!');
			$this->redirectManage();
			return;
		}

		//Seta valores do publico para ser mostrado na view
		$this->view->assign("public", $public);

		//A ação vai ser editar.
		$this->view->assign("action","update");
		//O PublicForm vai ser usado tanto no upate quando no cadastro.
		$page = "PublicForm";
		$this->view->display($page);
	}

	/** 
	* Redireciona para a página específica de cadastrar um publico.
	*/
	public function redirectCreate(){
		//A ação vai ser criar.
		$this->view->assign("action","create");
		
		$page = "PublicForm";
		$this->view->display($page);
	}

	/** 
	* Redireciona para a página específica de gerenciar um campo.
	*/
	public function redirectManage(){
		$publics = $this->dao->findAll();
		//Todos os publicos serão exibidos na view.
		$this->view->assign("publics", $publics);

		$page = 'ManagePublics';
		$this->view->display($page);
	}
}
?>