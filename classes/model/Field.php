<?php 

use Doctrine\Common\Collections\ArrayCollection;

/**
* @Entity
* @Table(name = "field")
*/
class Field
{
	public function __construct() {
        $this->children = new ArrayCollection();
    }

	/**
     * @Id @Column(type="integer")
     * @GeneratedValue
     **/
	protected $id;

	/**
     * @Column(type="string")
     **/
    protected $name;

	/**
	 * @OneToMany(targetEntity="Field", mappedBy="parent", cascade ={"remove"})
	 * @var ArrayCollection<Field>
	 **/
    private $children;

    /**
     * @ManyToOne(targetEntity="Field", inversedBy="children")
     * @JoinColumn(name="parent_id", referencedColumnName="id")
     * @var Field
     **/
    private $parent;

    /**
     * @ManyToMany(targetEntity="User", mappedBy="actingArea")
     * @var User
     **/
    private $users;

    //encapsular

    /**
    *	Adiciona um novo campo como filho e já seta para este novo campo o seu campo "pai".
    *	
    *	@param $child campo filho para ser adicionado.
    */
    public function addChild(Field $child){
    	$this->children->add($child);
    	$child->setParent($this);
    }

    /**
    *	Remove um campo filho e seta seu pai como null.
    *
    *	OBS: O campo filho é removido pela chave, sendo assim, o nome não é comparado.
    *	@param $child campo filho para ser removido.
    */
    public function removeChild(Field $child){
    	$this->children->remove($child->getId());
    	$child->setParent(null);
    }

    /**
    *	Remove um campo filho e seta seu pai como null.
    *
    *	@param $id id do campo filho para ser removido.
    */
    public function removeChildById($id){
    	$child = $this->children->get($id);
    	$this->children->remove($id);
    	$child->setParent(null);
    }

    public function getChildren(){
    	$this->children->toArray();
    }

    public function setParent(Field $parent){
    	$this->parent = $parent;
    }

    public function getParent(){
    	return $this->parent;
    }

    public function getId(){
    	return $this->id;
    }

    public function setId($id){
    	$this->id = $id;
    }

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}
}

?>