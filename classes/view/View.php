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
  	private $array_param = array();

    /**
     * Array que guarda nome do script do css. 
     * Não é necessário o nome da extensão.  
     * Lembrete: Os scripts do CSS e do JS do layout serão carregados por padrão. 
     *
     *@name array_css
     */
  	private $array_css = array();

    /**
     * Array que guarda o nome dos scripts do JS
     * Não é necessário o nome da extensão.  
     * Lembrete: Os scripts do CSS e do JS do layout serão carregados por padrão. 
     *
     *@name array_js
     */
  	private $array_js = array();

    /**
     * Array que guarda as mensagens de erro de nosso sistema.
     * Esse array é usado para popular uma parte, de preferência em vermelho, do nosso layout.
     * 
     *
     *@name error_message
     */
  	private $error_message = array();

    /**
     * Array que guarda as mensagens de sucesso de nosso sistema.
     * Esse array é usado para popular uma parte, de preferência em verde, do nosso layout.
     * É ideal para confirmar um cadastro ou a efetivação de alguma doação
     *
     *@name success_message
     */
  	private $success_message = array();

    /**
     * String que guarda o título da pagina
     *
     *@name title
     */
    private $title;

    public function View(){
      $this->title = "Sistemas JCI";
    }

  	public function assign($key, $value){
  		$this->array_param[$key] = $value;
  	}

  	public function assign_error($message){
  		array_push($this->error_message, $message);
  	}

  	public function assign_success($message){
  		array_push($this->success_message, $message);
  	}

  	public function add_js($name_js){
  		array_push($this->array_js, $name_js);
  	}

  	public function add_css($name_css){
  	 	array_push($this->array_css, $name_css);
  	}

  	public function display($content){

      $title = $this->title;
      $error_message = $this->error_message;
      $success_message = $this->success_message;
      $array_css = $this->array_css;
  		
      extract($this->array_param);

  		include "Layout.php";
  	}

    public function setTitle($title_name){
      $this->title = $title_name;
    }

  }
?>