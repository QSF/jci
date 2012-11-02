<?php 

use Doctrine\Common\Collections\ArrayCollection;

/**
* @Entity
* @Table(name = "public")
*/
class PublicServed
{
    public function __construct() {
        $this->users = new ArrayCollection();
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
     * @ManyToMany(targetEntity="User", mappedBy="public")
     * @var ArrayCollection<User>
     **/
    private $users;

    //encapsular para a relação com o usuário

    public function addUser(User $user){
        if ($user === null)
            return;
        $this->users->add($user);
    }

    /**
    *   O método remove o usuário pela chave, não checando outros campos.
    *
    */
    public function removeUser(User $user){
        if ($user === null)
            return;
        $this->users->remove($user->getId());
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