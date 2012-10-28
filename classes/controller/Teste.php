<?php

//Classe de Exemplo que representa como um controller deverá se comportar
//Esse jeito foi o jeito que eu pensei como ficará nosso controller
// Fiquem livres para opinar e mudar qualquer coisa
//

//Interessante ter um script global chamado config.php?
//Esse script setaria o path dos modulos ou dos componentes do mvc
//include $view_path/View.php
//require_once (VIEW_PATH . "/View.php");

class Teste{
	
	private $request;
	
	public function __construct(Request $request){
		echo "Construtor da classe de teste<br/>";
	}
	
	public function TesteCadastro(){
		echo "To no método do controller<br/>";

		// Ilustrativo com user 
		//$user = new User
		//$user->setName($this->request->get("username"));
		//$user->setEmail($this->request->get("email"));

		//Uma ideia é pegar a registry da classe requisicao 
		//$registry = request->get("Registry");
		//se nao encapsularmos a requisicao teremos que saber o metodo http
		//if(metodo == get)
		//	$registry = $_GET['registry'];
		//else
		// $registry = $_POST['registry'];

		//Nao podemos simplesmente alocar uma nova registry, pois ela nao tera nenhum objeto setado em seu array
		//Logo, ela será inútil. 
		//Entao, creio $registry = new $Registry() não irá nos servir


		//Depois de pegar a registry, temos que persistir nosso user.
		//$user_dao = $registry->get("UserDAO");
		//$boolean_sucesso = $user_dao->save($user);

		//boolean_sucesso = $user_dao->save
		//Depois de persistir nosso usuario, queremos mandar uma mensagem customizada para ele

		//Simulando 
		$sucesso = true;

		if($sucesso){

	//Lembrem-se que pegaremos todos os objetos que podem variar diretamente da registry
			//$view = $request->get("registry");
	//Se eu quisesse uma view feita de outro jeito em todo controller precisaria mudar a declaração abaixo
	//		$view = $registry->get("View");		
	//		$view = new View();
			$view = ServiceLocator::getInstance()->getView('View');

			$view->assign("listaUsuarios", "listaUsuarios");
			$view->add_css("editor");
			$view->assign_success("Usuario cadastrado com sucesso");
			$view->setTitle("Cadastro do Usuário");

			$view->display("Home");


	} 	

		
	} 
}

?>
