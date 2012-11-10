<?php
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="donation")
 **/
class Donation
{
    /**
     *@Id @Column(type="integer")
     *@GeneratedValue
     **/
    protected $id = null;

    /**
    * @Column(type="datetime")
    * @var TimeStamp
    */
    protected $date;

    /**
    * @Column(type="string")
    * @var String
    */
    protected $moreInfo;

    /**
    * @Column(type="string", nullable=true)
    * @var string
    */
    protected $feedBackVolunteer;

    /**
    * @Column(type="datetime", nullable=true)
    * @var TimeStamp
    */
    protected $dateFeedBackVolunteer;

    /**
    * @Column(type="string", nullable=true)
    * @var string
    */
    protected $feedBackEntity;

    /**
    * @Column(type="datetime", nullable=true)
    * @var TimeStamp
    */
    protected $dateFeedBackEntity;

    /**
     * @ManyToOne(targetEntity="Volunteer", inversedBy="donations")
     * @JoinColumn(name="volunteer_id", referencedColumnName="id")
     **/
    protected $volunteer;

    /**
     * @ManyToOne(targetEntity="Entity", inversedBy="donations")
     * @JoinColumn(name="entity_id", referencedColumnName="id")
     **/
    protected $entity;

    /**
     * @ManyToOne(targetEntity="Moderator", inversedBy="donations")
     * @JoinColumn(name="moderator_id", referencedColumnName="id")
     **/
    protected $moderator;

    /**
     * @ManyToOne(targetEntity="Field", inversedBy="donations")
     * @JoinColumn(name="field_id", referencedColumnName="id")
     **/
    protected $field;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getMoreInfo(){
        return $this->moreInfo;
    }

    public function setMoreInfo($moreInfo){
        $this->moreInfo = $moreInfo;
    }

    public function getFeedBackVolunteer(){
        return $this->feedBackVolunteer;
    }

    public function setFeedBackVolunteer($feedBackVolunteer){
        $this->feedBackVolunteer = $feedBackVolunteer;
        $this->setDateFeedBackVolunteer(new DateTime);
    }

    public function getDateFeedBackVolunteer(){
        return $this->dateFeedBackVolunteer;
    }

    public function setDateFeedBackVolunteer($dateFeedBackVolunteer){
        $this->dateFeedBackVolunteer = $dateFeedBackVolunteer;
    }

    public function getFeedBackEntity(){
        return $this->feedBackEntity;
    }

    public function setFeedBackEntity($feedBackEntity){
        $this->feedBackEntity = $feedBackEntity;
        $this->setDateFeedEntity(new DateTime);
    }

    public function getDateFeedBackEntity(){
        return $this->dateFeedBackEntity;
    }

    public function setDateFeedBackEntity($dateFeedBackEntity){
        $this->dateFeedBackEntity = $dateFeedBackEntity;
    }

    public function getVolunteer(){
        return $this->volunteer;
    }

    public function setVolunteer(Volunteer $volunteer = null){
        $this->volunteer = $volunteer;
    }

    public function getEntity(){
        return $this->entity;
    }

    public function setEntity(Entity $entity = null){
        $this->entity = $entity;
    }

    public function getModerator(){
        return $this->moderator;
    }

    public function setModerator(Moderator $moderator = null){
        $this->moderator = $moderator;
    }

    public function getField(){
        return $this->field;
    }

    public function setField(Field $field = null){
        $this->field = $field;
    }
}

    