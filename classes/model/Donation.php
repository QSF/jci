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

    /**
     * @PrePersist
     *
     *  Função que seta o tempo da doação com o horário atual.
     **/
    public function beforePersist(){
        $this->setDate(new DateTime());
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getDate(){
        return $this->date;
    }

    public function setFeedBackVolunteer($feedBackVolunteer){
        $this->feedBackVolunteer = $feedBackVolunteer;
        $this->setDateFeedBackVolunteer(new DateTime);
    }

    public function getFeedBackVolunteer(){
        return $this->feedBackVolunteer;
    }

    public function setDateFeedBackVolunteer($dateFeedBackVolunteer){
        $this->dateFeedBackVolunteer = $dateFeedBackVolunteer;
    }

    public function getDateFeedBackVolunteer(){
        return $this->dateFeedBackVolunteer;
    }

    public function setFeedBackEntity($feedBackEntity){
        $this->feedBackEntity = $feedBackEntity;
        $this->setDateFeedEntity(new DateTime);
    }

    public function getFeedBackEntity(){
        return $this->feedBackEntity;
    }

    public function setDateFeedEntity($dateFeedBackEntity){
        $this->dateFeedBackEntity = $dateFeedBackEntity;
    }

    public function getDateFeedEntity(){
        return $this->dateFeedBackEntity;
    }

    public function setVolunteer(Volunteer $volunteer){
        $this->volunteer = $volunteer;
    }

    public function getVolunteer(){
        return $this->volunteer;
    }

    public function setEntity(Entity $entity){
        $this->entity = $entity;
    }

    public function getEntity(){
        return $this->entity;
    }

    public function setModerator(Moderator $moderator){
        $this->moderator = $moderator;
    }

    public function getModerator(){
        return $this->moderator;
    }

    public function setField(Field $field){
        $this->field = $field;
    }

    public function getField(){
        return $this->field;
    }
}

    