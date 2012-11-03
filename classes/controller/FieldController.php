<?php

/** 
 *  Controller responsável pelas ações sobre os campos.
 * 	Basicamente o CRUD e a parte de redirecionar para páginas específicas.
 *	@todo fazer uma paginação quando for exibir todos os campos.
 */
class FieldController extends ApplicationController{

	private $dao;

	public function __construct(Request $request){
		parent::__construct($request);	
		$this->dao = ServiceLocator::getInstance()->getDAO("FieldDAO");
	}

	
	/** 
	* Método que cria um novo campo.
	*/
	public function create(){
		$field = $this->request->getField();//aqui seria getPublic.

		if ($field === null){
			$this->view->assignError('O campo não existe!');
			$this->redirectManage();
			return;
		}

		if ($field->getParent() != null){//se for null é macro
			$parentField = $this->dao->findById($field->getParent());
			
			if ($parentField === null)
				$this->view->assignError('O campo não existe!');

			$field->setParent($parentField);
		}
		$this->dao->insert($field);
		$this->view->assignSuccess('Campo criado com sucesso.');

		$this->redirectManage();
	}

	/** 
	* 	Método que atualiza um determinado campo.
	*	@todo ver permissão.
	*	@todo No form de edição, tem que passar o id do campo.
	*/
	public function update(){
		$field = $this->request->getField();

		if ($field === null){
			$this->view->assignError('O campo não existe!');
			$this->redirectManage();
			return;
		}

		if ($field->getParent() != null && $field->getId() == $field->getParent()->getId() ){//ele não pode ser pai dele mesmo.
			$this->view->assignError('O campo não pode ser subcampo dele mesmo!');
			$this->redirectUpdate();
			return;
		}
		
		$this->dao->update($field);

		$this->view->assignSuccess('O campo ' . $field->getName() . ' foi editado com sucesso!');
		$this->redirectManage();
	}

	/** 
	* Método que remove um capo do banco de dados.
	* @todo Retornar uma msg caso este campo já tenha alguém relacionado com ele.
	* @todo Verficar permissão (apesar que eu penso que isso deve ser feito no FC.
	*/
	public function delete(){
		$field = $this->request->getField();

		if ($field === null){
			$this->view->assignError('O campo não existe!');
			$this->redirectManage();
			return;
		}
		

		$field = $this->dao->findById($field);
		if ($field === null){
			$this->view->assignError('O campo não existe!');
			$this->redirectManage();
			return;
		}
		
		try {
			$this->dao->delete($field);

			$this->view->assignSuccess('O campo' . $field->getName() . 'foi removido com sucesso!');
		} catch(Exception $e){//pegar a exception exata se há ou não usuário ou doação com este campo
	    	$this->view->assignError('O campo não pode ser removido!');
	    }	
	    $this->redirectManage();
	}

	/** 
	* Redireciona para a página específica de editar um campo.
	* Os valores atuais do campo serão carregados.
	*/
	public function redirectUpdate(){
		$field = $this->request->getField();//seta o id

		if ($field === null){
			$this->view->assignError('O campo não existe!');
			$this->redirectManage();
			return;
		}
		$field = $this->dao->findById($field);//busca o campo completo do banco

		if ($field === null){
			$this->view->assignError('O campo não existe!');
			$this->redirectManage();
			return;
		}

		//Seta valores do campo para ser mostrado na view
		$this->view->assign("field", $field);

		$fields = $this->dao->findAllMacros();//pega todos os campos macros
		//Todos os campos serão exibidos na view.
		$this->view->assign("fields", $fields);

		//A ação vai ser editar.
		$this->view->assign("action","update");
		//O FieldForm vai ser usado tanto no upate quando no cadastro.
		$page = "FieldForm";
		$this->view->display($page);
	}

	/** 
	* Redireciona para a página específica de cadastrar um campo.
	*/
	public function redirectCreate(){
		$fields = $this->dao->findAllMacros();//pega todos os campos macros
		//Todos os campos serão exibidos na view.
		$this->view->assign("fields", $fields);

		//A ação vai ser criar.
		$this->view->assign("action","create");
		//O FieldForm vai ser usado tanto no upate quando no cadastro.
		$page = "FieldForm";
		$this->view->display($page);
	}

	/** 
	* Redireciona para a página específica de cadastrar um campo.
	*/
	public function redirectManage(){
		$fields = $this->dao->findAllMacros();//pega todos os campos macros
		//Todos os campos serão exibidos na view.
		$this->view->assign("fields", $fields);

		$page = 'ManageFields';
		$this->view->display($page);
	}
}
?>