<?php

namespace jci\Doctrine\Proxies\__CG__;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Entity extends \Entity implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function setEstablishmentDate($establishmentDate)
    {
        $this->__load();
        return parent::setEstablishmentDate($establishmentDate);
    }

    public function getEstablishmentDate()
    {
        $this->__load();
        return parent::getEstablishmentDate();
    }

    public function setSite($site)
    {
        $this->__load();
        return parent::setSite($site);
    }

    public function getSite()
    {
        $this->__load();
        return parent::getSite();
    }

    public function setSituation($situation)
    {
        $this->__load();
        return parent::setSituation($situation);
    }

    public function getSituation()
    {
        $this->__load();
        return parent::getSituation();
    }

    public function setStatus($status)
    {
        $this->__load();
        return parent::setStatus($status);
    }

    public function getStatus()
    {
        $this->__load();
        return parent::getStatus();
    }

    public function setNewsletter($newsletter)
    {
        $this->__load();
        return parent::setNewsletter($newsletter);
    }

    public function getNewsletter()
    {
        $this->__load();
        return parent::getNewsletter();
    }

    public function setCnpj($cnpj)
    {
        $this->__load();
        return parent::setCnpj($cnpj);
    }

    public function getCnpj()
    {
        $this->__load();
        return parent::getCnpj();
    }

    public function setCompanyName($companyName)
    {
        $this->__load();
        return parent::setCompanyName($companyName);
    }

    public function getCompanyName()
    {
        $this->__load();
        return parent::getCompanyName();
    }

    public function setStateRegistration($stateRegistration)
    {
        $this->__load();
        return parent::setStateRegistration($stateRegistration);
    }

    public function getStateRegistration()
    {
        $this->__load();
        return parent::getStateRegistration();
    }

    public function setOwnerPhone($ownerPhone)
    {
        $this->__load();
        return parent::setOwnerPhone($ownerPhone);
    }

    public function getOwnerPhone()
    {
        $this->__load();
        return parent::getOwnerPhone();
    }

    public function addDonation(\Donation $donation)
    {
        $this->__load();
        return parent::addDonation($donation);
    }

    public function removeDonation(\Donation $donation)
    {
        $this->__load();
        return parent::removeDonation($donation);
    }

    public function removeDonationById($id)
    {
        $this->__load();
        return parent::removeDonationById($id);
    }

    public function getDonations()
    {
        $this->__load();
        return parent::getDonations();
    }

    public function addPublic(\PublicServed $public)
    {
        $this->__load();
        return parent::addPublic($public);
    }

    public function removePublic(\PublicServed $public)
    {
        $this->__load();
        return parent::removePublic($public);
    }

    public function removePublicById($id)
    {
        $this->__load();
        return parent::removePublicById($id);
    }

    public function addArea(\Field $area)
    {
        $this->__load();
        return parent::addArea($area);
    }

    public function removeArea(\Field $area)
    {
        $this->__load();
        return parent::removeArea($area);
    }

    public function removeAreaById($id)
    {
        $this->__load();
        return parent::removeAreaById($id);
    }

    public function getReceiveNotification()
    {
        $this->__load();
        return parent::getReceiveNotification();
    }

    public function setReceiveNotification($notification)
    {
        $this->__load();
        return parent::setReceiveNotification($notification);
    }

    public function getName()
    {
        $this->__load();
        return parent::getName();
    }

    public function setName($name)
    {
        $this->__load();
        return parent::setName($name);
    }

    public function getId()
    {
        $this->__load();
        return parent::getId();
    }

    public function setId($id)
    {
        $this->__load();
        return parent::setId($id);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function getPassword()
    {
        $this->__load();
        return parent::getPassword();
    }

    public function setPassword($password)
    {
        $this->__load();
        return parent::setPassword($password);
    }

    public function getPhone()
    {
        $this->__load();
        return parent::getPhone();
    }

    public function setPhone($phone)
    {
        $this->__load();
        return parent::setPhone($phone);
    }

    public function getHowYouKnow()
    {
        $this->__load();
        return parent::getHowYouKnow();
    }

    public function setHowYouKnow($howYouKnow)
    {
        $this->__load();
        return parent::setHowYouKnow($howYouKnow);
    }

    public function getPublic()
    {
        $this->__load();
        return parent::getPublic();
    }

    public function setPublic($public)
    {
        $this->__load();
        return parent::setPublic($public);
    }

    public function getActingArea()
    {
        $this->__load();
        return parent::getActingArea();
    }

    public function setActingArea($actingArea)
    {
        $this->__load();
        return parent::setActingArea($actingArea);
    }

    public function getCep()
    {
        $this->__load();
        return parent::getCep();
    }

    public function setCep($cep)
    {
        $this->__load();
        return parent::setCep($cep);
    }

    public function getActive()
    {
        $this->__load();
        return parent::getActive();
    }

    public function setActive($active)
    {
        $this->__load();
        return parent::setActive($active);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'receiveNotification', 'name', 'email', 'password', 'phone', 'howYouKnow', 'active', 'cep', 'public', 'actingArea', 'establishmentDate', 'site', 'situation', 'status', 'cnpj', 'companyName', 'stateRegistration', 'ownerPhone', 'donations');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}