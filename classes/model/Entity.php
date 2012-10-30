<?php
/** 
* @Entity 
* @Table(name="entity")
*/
class Entity extends User
{
	
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
	 * @Column(type="integer", unique = true, nullable=false) 
	 * @var int
	 */
	protected $cnpj;
	/** 
	 * @Column(type="string") 
	 * @var string
	 */
	protected $companyName;
	/** 
	 * @Column(type="integer") 
	 * @var int
	 */
	protected $stateRegistration;
	/** 
	 * @Column(type="integer")
	 * @var int
	 */
	protected $ownerPhone;


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
}
?>