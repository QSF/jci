<?php
use Doctrine\Common\Collections\ArrayCollection;

require_once MODEL_PATH . "/Entity.php";

/**
 * @Entity 
 * @Table(name="user")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="user_type", type="string")
 * @DiscriminatorMap({"entity" = "Entity",
 *                    "volunteerLegalPerson" = "VolunteerLegalPerson",
 *                    "volunteerNaturalPerson" = "VolunteerNaturalPerson"})
 **/
abstract class User
{

    /**
     *@Id @Column(type="integer")
     *@GeneratedValue
     **/
    protected $id = null;

    /**
    * @Column(type="boolean")
    */
    protected $receiveNotification;

    /**
     * @Column(type="string", nullable=false, length=50)
     **/
    protected $name;

    /**
     *@Column(type="string")
     **/
    protected $email;

    /**
     *@Column(type="string")
     **/
    protected $password;

    /**
     *@Column(type="integer")
     **/
    protected $phone;

    /**
     *@Column(type="string")
     **/
    protected $howYouKnow;

    /** Relação do publico atendido.
     *
     * @var ArrayCollection<PublicServed>
     **/
    protected $public;

    /** Relação dos campos de cada usuario
     * @var ArrayCollection<Field>
     **/
    protected $actingArea;

    /**
     *@Column(type="integer")
     **/
    protected $cep;

    public function __construct(){
        $this->public = new ArrayCollection();
        $this->actingArea = new ArrayCollection();
    }

    //encapsulamento do public
    public function addPublic (PublicServed $public){
        if ($public === null)
            return;
        $this->public->add($public);
        $public->addUser($this);
    }

    /**
    *   Remove um publico atendido
    *   O usuário ja é retirado do publico(na classe PublicServed).
    *   OBS: O publico é removido pela chave, sendo assim, o nome não é comparado.
    *   @param $public public para ser removido.
    */
    public function removePublic (PublicServed $public){
        if ($public === null || $this->public->remove($public->getId()) === null) //publico não é atendido por este usuário
            return;
        $public->removeUser($this);
    }

    /**
    *   Remove um publico atendido.
    *   O usuário ja é retirado do publico(na classe PublicServed).
    *   @param $id id do publico para ser removido.
    */
    public function removePublicById ($id){
        if ($id === null)
            return;

        $public = $this->public->get($id);

        if ($public === null)
            return;

        $this->public->remove($id);
        $public->removeUser($this);
    }

    //encapsulamento do field
    public function addArea (Field $area){
        if ($area === null)
            return;
        $this->actingArea->add($area);
        $area->addUser($this);
    }

    /**
    *   Remove uma área de atuação.
    *   O usuário ja é retirado do fild(na classe Field).
    *   OBS: A área de atuação é removida pela chave, sendo assim, o nome não é comparado.
    *   @param $area area para ser removida.
    */
    public function removeArea (Field $area){
        if ($area === null || $this->actingArea->remove($area->getId()) === null) //publico não é atendido por este usuário
            return;
        $area->removeUser($this);
    }

    /**
    *   Remove uma área de atuação.
    *   O usuário ja é retirado do fild(na classe Field).
    *   @param $id id da área de atuação para ser removida.
    */
    public function removeAreaById ($id){
        if ($id === null)
            return;

        $area = $this->actingArea->get($id);

        if ($area === null)
            return;

        $this->actingArea->remove($id);
        $area->removeUser($this);
    }

    public function getReceiveNotification(){
        return $this->receiveNotification;
    }

    public function setReceiveNotification($notification){
        $this->receiveNotification = $notification;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function getHowYouKnow(){
        return $this->howYouKnow;
    }

    public function setHowYouKnow($howYouKnow){
        $this->howYouKnow = $howYouKnow;
    }

    public function getPublic(){
        //return $this->public->toArray();
    }

    public function setPublic($public){
        $this->public = $public;
    }

    public function getActingArea(){
      //  return $this->actingArea->toArray();
    }

    public function setActingArea($actingArea){
        $this->actingArea = $actingArea;
    }

    public function getCep(){
        return $this->cep;
    }

    public function setCep($cep){
        $this->cep = $cep;
    }
}

    