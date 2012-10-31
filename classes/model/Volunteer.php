<?php
require_once MODEL_PATH . "/User.php";
require_once MODEL_PATH . "/VolunteerLegalPerson.php";
require_once MODEL_PATH . "/VolunteerNaturalPerson.php";
/**
 * @Entity
 * @Table(name="volunteer")
 */
abstract class Volunteer extends User
{	
	/** @Column(type="string") */
	protected $experience;

	public function setExperience($experience)
	{
		$this->experience = $experience;
	}

	public function getExperience()
	{
		return $this->experience;
	}
}
?>