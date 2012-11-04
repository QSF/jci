<?php 

/**
* @Entity
* @Table(name = "moderator")
*/
class Moderator{

    public function __construct() {
        $this->donations = new ArrayCollection();
    }

	/**
     *@Id @Column(type="integer")
     *@GeneratedValue
     **/
	protected $id;

	/**
	* @Column(type = "string", unique=true,  nullable = false)
	*/
	protected $login;

	/**
	* @Column(type = "string", nullable = false)
	*/
	protected $password;

	/**
    * @Column(type="string")
    **/
    protected $email;

    /**
     * @OneToMany(targetEntity="Donation", mappedBy="moderator")
     **/
	protected $donations;

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getId(){
    	return $this->id;
    }

    public function setId($id){
    	$this->id = $id;
    }

    //encapsular do donations

     /**
    *	Adiciona uma doação que este moderador intermediou.
    *	
    *	@param $donation Doação.
    */
    public function addDonation(Donation $donation){
    	if ($donation === null)
    		return;
    	$this->donations->add($donation);
    	$donation->setModerator($this);
    }

    /**
    *	Remove uma doação que este moderador intermediou.
    *
    *	OBS: A doação é removida pela chave, sendo assim, outros campos não são comparados.
    *	@param $donation Doação.
    */
    public function removeDonation(Donation $donation){
    	if ($donation === null || $this->donations->remove($donation->getId()) === null)
    		return;
    	$donation->setModerator(null);
    }

    /**
    *	Remove uma doação que este moderador intermediou.
    *   O moderador da doação é setado como nulo.
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
    	$donation->setModerator(null);
    }

    public function getDonations(){
        return $this->donations->toArray();
    }

}

?>