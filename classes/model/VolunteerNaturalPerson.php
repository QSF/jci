<?php
require_once MODEL_PATH . "/Volunteer.php";

/** 
* @Entity
* @Table(name="volunteer_natural_person")
*/
class VolunteerNaturalPerson extends Volunteer
{	
	/**
	* @Column(type="integer", unique = true, nullable=false) 
	* @var int
	*/
	protected $cpf;

	public function setCpf($cpf)
	{
		$this->cpf = $cpf;
	}

	public function getCpf()
	{
		return $this->cpf;
	}
}
?>