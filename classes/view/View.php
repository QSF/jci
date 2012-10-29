<?php
/**
  * Classe que representa a view de nosso sistema 
  *
  * A classe view foi feita pra representar o estado de nossos modelos e formatar nosso layout
  * É composto essencialmente de um array que guarda os objetos usados na nossa view.
  * Se por exemplo, depois de uma intermediação de dados, há uma lista de entidadades,
  * o único trabalho será chamar em nossos controllers $view->assign("lista_voluntarios", $lista)
  * Em nossa área de conteúdo, é possível usar o lista_voluntários.
  * Para printar o nosso conteúdo na tela, é simplesmente  
  * 
  * A view desse jeito será baseada no template engine do php chamado Smarty
  */
  
  class View{

    /**
     * Hash que guarda os parâmetros de requisição setadas pelo controller. 
     * Esse hash ilustra o estado do modelo. 
     * Os valores serão usados no script que será incluído pelo parâmetro content do método display
     * 
     *
     *@name array_param
     */
  	private $paramArray = array();

    /**
     * Array que guarda nome do script do css. 
     * Não é necessário o nome da extensão.  
     * Lembrete: Os scripts do CSS e do JS do layout serão carregados por padrão. 
     *
     *@name array_css
     */
  	private $arrayCss = array();

    /**
     * Array que guarda o nome dos scripts do JS
     * Não é necessário o nome da extensão.  
     * Lembrete: Os scripts do CSS e do JS do layout serão carregados por padrão. 
     *
     *@name array_js
     */
  	private $arrayJs = array();

    /**
     * Array que guarda as mensagens de erro de nosso sistema.
     * Esse array é usado para popular uma parte, de preferência em vermelho, do nosso layout.
     * 
     *
     *@name error_message
     */
  	private $errorMessage = array();

    /**
     * Array que guarda as mensagens de sucesso de nosso sistema.
     * Esse array é usado para popular uma parte, de preferência em verde, do nosso layout.
     * É ideal para confirmar um cadastro ou a efetivação de alguma doação
     *
     *@name success_message
     */
  	private $successMessage = array();

    /**
     * Guarda o tipo de usuário que está acessando o sistema
     * 
     *@name success_message
     */
    private $userType;

    public function __construct($userType = UsersEnum::GUEST){
      $this->userType = $userType;
    }

    public function setUserType($userType){
      $this->userType = $userType;
    }

  	public function assign($key, $value){
  		$this->paramArray[$key] = $value;
  	}

  	public function assignError($message){
  		array_push($this->errorMessage, $message);
  	}

  	public function assignSuccess($message){
  		array_push($this->successMessage, $message);
  	}

  	public function addJs($nameJs){
  		array_push($this->arrayJs, $nameJs);
  	}

  	public function addCss($nameCss){
  	 	array_push($this->arrayCss, $nameCss);
  	}

    /**
     * Método que envia a página de resposta para o usuário
     * 
     *
     *@param content
     */
  	public function display($content){

      //pegando elementos da view que diferem do usuario
      $customView = $this->getCustomView();

      $errorMessage = $this->errorMessage;
      $successMessage = $this->successMessage;
      $arrayCss = $this->arrayCss;
  		$arrayJs = $this->arrayJs;

      //método extract serve para pegar as variaveis de uma map e transformar num variavel
      extract($customView);
      extract($this->paramArray);

  		include PAGES_PATH."/Layout.php";
  	}

    /**
     * Customiza a página da view do usuário
     * 
     * Método que seta as variaveis menu, loginSection dependendo do usuário
     *
     * @return customView
     */
    public function getCustomView(){
      $customView = array();
      if( $this->userType === UsersEnum::GUEST){
        $customView['menu'] = "GuestMenu.php";
        $customView['loginSection'] = "LoginSection.php";
      }
        
      else if( $this->userType === UsersEnum::ENTITY){
        $customView['menu'] = "EntityMenu.php";
        $customView['loginSection'] ="GreetingsUser.php";
      }

      else if( $this->userType === UsersEnum::VOLUNTEER_NATURAL_PERSON || 
                  $this->userType === UsersEnum::VOLUNTEER_LEGAL_PERSON){
        $customView['menu'] = "VolunteerMenu.php";
        $customView['loginSection'] = "GreetingsUser.php";
      }

      else if($this->userType === UsersEnum::ADMIN){
        $customView['menu'] = "AdminMenu.php";
        $customView['loginSection'] = "GreetingsUser.php";
      }

      else if($this->userType === UsersEnum::MODERATOR){
        $customView['menu'] = "ModeratorMenu.php";
        $customView['loginSection'] = "GreetingsUser.php";
      }
      return $customView;
    }
  }
?>