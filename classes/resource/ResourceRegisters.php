<?php 
/** Classe que contém vários objetos que criam serviços.
*
*	Esta classe possuirá um array de objetos que criam serviços(como factorys).
*/
class ResourceRegisters
{
	private $registers;

	function __construct()
	{
		$this->clear();
	}

	/**
     * Adiciona um Register para o array.
     * @todo padronizar os nomes(exemplo tudo minúsculo).
     */
    public function add($name, $value)
    {
        $this->registers[$name] = $value;
    }
    
    /**
     * @param $name nome do register para ser retornado.
     * @return o register correspondente ao nome(caso exista).
     * @return null caso não exista nenhum register com este nome.
     * @todo padronizar os nomes(exemplo tudo minúsculo).
     */
    public function get($name)
    {
        return isset($this->registers[$name]) ? $this->registers[$name] : null;
    }
    
    /** Limpa o conteúdo do array.
     * 
     */
    public function clear()
    {
        $this->registers = array();
    }
}
?>