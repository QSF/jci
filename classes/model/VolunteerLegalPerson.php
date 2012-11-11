<?php
require_once MODEL_PATH . "/Volunteer.php";

/** 
* @Entity 
* @Table(name="volunteer_legal_person")
*/
class VolunteerLegalPerson extends Volunteer
{	
	 public function __construct(){
		parent::__construct();	
    }
    
	/** 
	* @Column(type="string", length=14, nullable=false)
	* @var int
	*/
	protected $cnpj;
	/** 
	* @Column(type="string", nullable=false) 
	* @var string
	**/
	protected $companyName;
	/** 
	* @Column(type="string", length=10, nullable=false)
	* @var string
	*/
	protected $stateRegistration;
	/**
	* @Column(type="string", length=10, nullable=false)
	* @var string
	*/
	protected $ownerPhone;

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
}
?>