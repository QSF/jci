<?php 
/** Classe que mantém um cache de todos os recursos instanciados no sistem.
*
*	Possui um array de objetos, fornecendo uma estrutura para nosso ServiceLocator evitar retrabalho.
*	@see ServiceLocator. 
*/
class Cache
{
	protected $resources;
   	
   	function __construct()
	{
		$this->resources = array();
	}

    /**
     * Adiciona um recurso para o array de recursos.
     * @param  $key   identificador(preferencialmente string) do recurso.
     * @param  $value valor do recurso.
     * @todo padronizar os nomes(exemplo tudo minúsculo).
     */
    public function add($key, $value)
    {
        $this->resources[$key] = $value;
    }
    
    /**
     * @param  $key identificador(preferencialmente string) do recurso.
     * @return resource um recurso, caso exista um com este nome.
     * @return null caso não exista recurso com este nome.
     * @todo   padronizar os nomes(exemplo tudo minúsculo).
     */
    public function get($key)
    {
        return isset($this->resources[$key]) ? $this->resources[$key] : null;
    }
    
    /** Limpa o array de recursos.
     */
    public function clear()
    {
        $this->resources = array();
    }      
}
?>