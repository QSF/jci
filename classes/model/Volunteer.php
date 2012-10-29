<?php
require_once MODEL_PATH . "/User.php";
require_once MODEL_PATH . "/VolunteerLegalPerson.php";
require_once MODEL_PATH . "/VolunteerNaturalPerson.php";
/**
 * @Entity
 * @Table(name="volunteer")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="user_type", type="string")
 * @DiscriminatorMap({"volunteerLegalPerson" = "VolunteerLegalPerson", "volunteerNaturalPerson" = "VolunteerNaturalPerson"})
 */
abstract class Volunteer extends User
{	
	/** @Column(type="string") */
	protected $experience;

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setExperience($experience)
	{
		$this->experience = $id;
	}

	public function getExperience()
	{
		return $this->experience;
	}
}
?>