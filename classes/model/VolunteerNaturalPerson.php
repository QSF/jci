<?php
require_once MODEL_PATH . "/Volunteer.php";

/** 
* @Entity
* @Table(name="volunteer_natural_person")
*/
class VolunteerNaturalPerson extends Volunteer
{	
	public function __construct(){
		parent::__construct();	
    }
	/**
	* @Column(type="string", length=11, nullable=false)
	* @var string
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