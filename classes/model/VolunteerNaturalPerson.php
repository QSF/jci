<?php

/** @Entity*/
class VolunteerNaturalPerson extends Volunteer
{	
	/**@Column(type="integer", unique = true, nullable=false) 
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