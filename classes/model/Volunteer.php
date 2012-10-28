<?php

/**
 * @Entity
 * @Table(name="volunteer")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"volunteerLegalPerson" = "VolunteerLegalPerson", "volunteerNaturalPerson" = "VolunteerNaturalPerson"})
 */
abstract class Volunteer extends User
{	
	/**
	 * @Id
	 * @Column(type="integer")
	 * @generatedValue(strategy="IDENTITY")
	 * @var int
	 */
	protected $id = null;
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