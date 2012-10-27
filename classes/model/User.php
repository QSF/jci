<?php
/**
 * @Entity @Table(name="users")
 **/

//para popular a tabela no bd 
// digite doctrine orm:schema-tool:create

class User
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $name;

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($name){
        $this->name = $name;
    }
}