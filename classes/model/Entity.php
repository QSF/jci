<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
* @Entity 
* @Table(name="entity")
*/
class Entity extends User{
	
	public function __construct() {
        $this->donations = new ArrayCollection();
		parent::__construct();
    }
	/** 
	 * @Column(type="date") 
	 * @var date
	 */
	protected $establishmentDate;
	/** 
	 * @Column(type="string") 
	 * @var string 
	 */
	protected $site;
	/** 
	 * @Column(type="boolean") 
	 * @var boolean 
	 */
	protected $situation = false;
	/** 
	 * @Column(type="boolean") 
	 * @var boolean 
	 */
	protected $status = false;
	/** 
	 * @Column(type="boolean") 
	 * @var boolean 
	 */
	protected $newsletter;

	/** 
	 * @Column(type="string", length=11, nullable=false)
	 * @var int
	 */
	protected $cnpj;
	/** 
	 * @Column(type="string") 
	 * @var string
	 */
	protected $companyName;
	/** 
	 * @Column(type="string", length=10, nullable=false)
	 * @var int
	 */
	protected $stateRegistration;
	/** 
	 * @Column(type="integer")
	 * @var int
	 */
	protected $ownerPhone;

	/**
     * @OneToMany(targetEntity="Donation", mappedBy="entity")
     **/
	protected $donations;

    public function setEstablishmentDate($establishmentDate){
		$this->establishmentDate = $establishmentDate;
	}
    public function getEstablishmentDate(){
		return $this->establishmentDate;
	}
    public function setSite($site){
		$this->site = $site;
	}
    public function getSite(){
		return $this->site;
	}
    public function setSituation($situation){
		$this->situation = $situation;
	}
    public function getSituation(){
		return $this->situation;
	}
    public function setStatus($status){
		$this->status = $status;
	}
    public function getStatus(){
		return $this->status;
	}
    public function setNewsletter($newsletter){
		$this->newsletter = $newsletter;
	}
    public function getNewsletter(){
		return $this->newsletter;
	}
	
	public function setCnpj($cnpj)
	{
		$this->cnpj = $cnpj;
	}

	public function getCnpj()
	{
		return $this->cnpj;
	}

	public function setCompanyName($companyName)
	{
		$this->companyName = $companyName;
	}
	
	public function getCompanyName()
	{
		return $this->companyName;
	}

	public function setStateRegistration($stateRegistration)
	{
		$this->stateRegistration = $stateRegistration;
	}
	
	public function getStateRegistration()
	{
		return $this->stateRegistration;
	}

	public function setOwnerPhone($ownerPhone)
	{
		$this->ownerPhone = $ownerPhone;
	}
	
	public function getOwnerPhone()
	{
		return $this->ownerPhone;
	}	

	//encapsular do donations

     /**
    *	Adiciona uma doação que esta entidade recebeu.
    *	
    *	@param $donation Doação.
    */
    public function addDonation(Donation $donation){
    	if ($donation === null)
    		return;
    	$this->donations->add($donation);
    	$donation->setEntity($this);
    }

    /**
    *	Remove uma doação que esta entidade recebeu.
    *
    *	OBS: A doação é removida pela chave, sendo assim, outros campos não são comparados.
    *	@param $donation Doação.
    */
    public function removeDonation(Donation $donation){
    	if ($donation === null || $this->donations->remove($donation->getId()) === null)
    		return;
    	$donation->setEntity(null);
    }

    /**
    *	Remove uma doação que esta entidade recebeu.
    *   A entidade da doação é setado como nulo.
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
    	$donation->setEntity(null);
    }

	public function getDonations(){
    	return $this->donations->toArray();
    }
}
?>