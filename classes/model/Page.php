<?php

/**
 * @Entity 
 * @Table(name="page")
 */
class Page 
{
	/**
     * @Id @Column(type="string")
     */
	protected $name;

    /**
     * @Column(type="text", nullable=false)
     */
	protected $content;

	public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setContent($content){
        $this->content = $content;
    }
    
    public function getContent(){
        return $this->content;
    }
}

?>