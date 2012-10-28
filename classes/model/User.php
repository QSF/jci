<?php
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="user")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"volunteer" = "Volunteer", "entity" = "Entity"})
 **/

abstract class User
{

    /**
     *@Id @Column(type="integer")
     *@GeneratedValue
     **/
    protected $id;

    /**
    *@Column(type="boolean")
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

    /**
     *@Column(type="string")
     **/
    protected $public;

    //Esse campo terá uma lista de fields
    //Relacao ManyToMany com classe Field
    /**
     *
     **/
    // protected $actingArea = null;

    /**
     *@Column(type="integer")
     **/
    protected $cep;

    public function __construct(){
        // $this->actingArea = new ArrayCollection();
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

    public function getUserId(){
        return $this->id;
    }

    public function setUserId($name){
        $this->name = $name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->name;
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
        return $this->public;
    }

    public function setPublic($public){
        $this->public = $public;
    }

    public function getActingArea(){
        return $this->actingArea;
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

    