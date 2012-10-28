<?php

/** @Entity */
class VolunteerLegalPerson extends Volunteer
{	
	/**@Column(type="integer", unique = true, nullable=false) 
	*@var int
	*/
	protected $cnpj;
	/**@Column(type="string") 
	*@var string
	**/
	protected $companyName;
	/**@Column(type="integer") 
	* @var int
	*/
	protected $stateRegistration;
	/**@Column(type="integer")
	* @var int
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