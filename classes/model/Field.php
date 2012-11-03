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
        $this->users = new ArrayCollection();
        $this->donations = new ArrayCollection();
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
    private $parent = null;

    /**
     * @ManyToMany(targetEntity="User", mappedBy="actingArea")
     * @var ArrayCollection<User>
     **/
    private $users;

    /**
     * @OneToMany(targetEntity="Donation", mappedBy="field")
     **/
	protected $donations;

    //encapsular para o campo filho e pai

    /**
    *	Adiciona um novo campo como filho e já seta para este novo campo o seu campo "pai".
    *	
    *	@param $child campo filho para ser adicionado.
    */
    public function addChild(Field $child){
    	if ($child === null)
    		return;
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
    	if ($child === null || $this->children->remove($child->getId()) === null)//este campo não é filho
    		return;
    	$child->setParent(null);
    }

    /**
    *	Remove um campo filho e seta seu pai como null.
    *
    *	@param $id id do campo filho para ser removido.
    */
    public function removeChildById($id){
    	if ($id === null)
    		return;

    	$child = $this->children->get($id);

    	if ($child === null)
    		return;

    	$this->children->remove($id);
    	$child->setParent(null);
    }

    //encapsular para a relação com o usuário

    public function addUser(User $user){
    	if ($user === null)
    		return;
    	$this->users->add($user);
    }

    /**
    *	O método remove o usuário pela chave, não checando outros campos.
    *
    */
    public function removeUser(User $user){
    	if ($user === null)
    		return;
    	$this->users->remove($user->getId());
    }

    public function getChildren(){
    	$this->children->toArray();
    }

    public function setParent(Field $parent = null){
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

	//encapsular do donations

     /**
    *	Adiciona uma doação que pertence a esta área.
    *	
    *	@param $donation Doação.
    */
    public function addDonation(Donation $donation){
    	if ($donation === null)
    		return;
    	$this->donations->add($donation);
    	$donation->setField($this);
    }

    /**
    *	Remove uma doação que pertence a esta área.
    *
    *	OBS: A doação é removida pela chave, sendo assim, outros campos não são comparados.
    *	@param $donation Doação.
    */
    public function removeDonation(Donation $donation){
    	if ($donation === null || $this->donations->remove($donation->getId()) === null)
    		return;
    	$donation->setField(null);
    }

    /**
    *	Remove uma doação que pertence a esta área.
    *   O campo da doação é setado como nulo.
    *
    *	@param $id id da doação para ser removida.
    */
    public function removeDonationById($id){
    	if ($id === null)
    		return;

    	$donation = $this->donations->get($id);

    	if ($donation === null)
    		return;

    	$this->donations->remove($id);
    	$donation->setField(null);
    }

    public function getDonations(){
    	$this->donations->toArray();
    }
}

?>