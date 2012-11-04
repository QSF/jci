<?php
require_once MODEL_PATH . "/User.php";
require_once MODEL_PATH . "/VolunteerLegalPerson.php";
require_once MODEL_PATH . "/VolunteerNaturalPerson.php";

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="volunteer")
 */
abstract class Volunteer extends User{	
	
	public function __construct() {
        $this->donations = new ArrayCollection();
        parent::__construct();  
    }

	/** @Column(type="string") */
	protected $experience;

	/**
     * @OneToMany(targetEntity="Donation", mappedBy="volunteer")
     **/
	protected $donations;

	public function setExperience($experience)
	{
		$this->experience = $experience;
	}

	public function getExperience()
	{
		return $this->experience;
	}

    //encapsular do donations

    /**
     *	Adiciona uma doação que este voluntário participou.
     *	
     *	@param $donation Doação.
    */
    public function addDonation(Donation $donation){
    	if ($donation === null)
    		return;
    	$this->donations->add($donation);
    	$donation->setVolunteer($this);
    }

    /**
    *	Remove uma doação que este voluntário participou.
    *
    *	OBS: A doação é removida pela chave, sendo assim, outros campos não são comparados.
    *	@param $donation Doação.
    */
    public function removeDonation(Donation $donation){
    	if ($donation === null || $this->donations->remove($donation->getId()) === null)
    		return;
    	$donation->setVolunteer(null);
    }

    /**
    *	Remove uma doação que este voluntário participou.
    *   O voluntário da doação é setado como nulo.
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
    	$donation->setVolunteer(null);
    }

    public function getDonations(){
    	return $this->donations->toArray();
    }
}
?>