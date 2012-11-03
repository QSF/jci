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
  
abstract class View{

    /**
     * Hash que guarda os parâmetros de requisição setadas pelo controller. 
     * Esse hash ilustra o estado do modelo. 
     * Os valores serão usados no script que será incluído pelo parâmetro content do método display
     * 
     *
     *@name array_param
     */
  	protected $paramArray = array();

    /**
     * Array que guarda nome do script do css. 
     * Não é necessário o nome da extensão.  
     * Lembrete: Os scripts do CSS e do JS do layout serão carregados por padrão. 
     *
     *@name array_css
     */
  	protected $arrayCSS = array();

    /**
     * Array que guarda o nome dos scripts do JS
     * Não é necessário o nome da extensão.  
     * Lembrete: Os scripts do CSS e do JS do layout serão carregados por padrão. 
     *
     *@name array_js
     */
  	protected $arrayJS = array();

    /**
     * Array que guarda as mensagens de erro de nosso sistema.
     * Esse array é usado para popular uma parte, de preferência em vermelho, do nosso layout.
     * 
     *
     *@name error_message
     */
  	protected $errorMessage = array();

    /**
     * Array que guarda as mensagens de sucesso de nosso sistema.
     * Esse array é usado para popular uma parte, de preferência em verde, do nosso layout.
     * É ideal para confirmar um cadastro ou a efetivação de alguma doação
     *
     *@name success_message
     */
  	protected $successMessage = array();

    /**
     * Atributo layout te dá liberdade de escolher outro layout.
     *
     *@name layout
     */
    protected $layoutName;

    public function __construct($layoutName = "Layout"){
      $this->layoutName = $layoutName;
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

  	public function addJS($nameJs){
  		array_push($this->arrayJS, $nameJs);
  	}

  	public function addCSS($nameCss){
  	 	array_push($this->arrayCSS, $nameCss);
  	}

    public function getLayout(){
      return $this->layoutName;
    }

    public function setLayout($layoutName){
      return $this->layoutName = $layoutName;
    }

    /**
     * Método que envia a página de resposta para o usuário
     * 
     *
     *@param content
     */
  	public function display($content = "Home"){

      $errorMessage = $this->errorMessage;
      $successMessage = $this->successMessage;
     // $this->loadResources($content);

      $arrayCSS = $this->arrayCSS;
  		$arrayJS = $this->arrayJS;

      //método extract serve para pegar as variaveis de uma map e transformar num variavel
     // extract($customView);
      extract($this->paramArray);
      
  		include PAGES_PATH."/".$this->layoutName.".php";
  	}

    /**
     * Método que aloca recursos de JS e CSS para cada página especifica
     * 
     * Esse método procura a página de conteudo que o usuário quer acessar e 
     * pega os atributos de JS e CSS para colocar no layout.
     *
     *@see config-view.xml
     *@param content
     */
    public function loadResources($content){
      //carrega o arquivo xml passado
      $resources = simplexml_load_file(CONFIG_PATH."/config-view.xml");

      foreach($resources->children() as $page)

        if($page["content"] == $content)
          foreach($page->children() as $viewResources)
            
            if($viewResources->getName() == "JS")
            foreach($viewResources->children() as $file)
              $this->addJS($file);
            
            else if($viewResources->getName() == "CSS")
              foreach($viewResources->children() as $file)
                $this->addCSS($file);
    }

  }
?>