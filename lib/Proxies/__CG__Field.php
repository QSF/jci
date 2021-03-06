<?php

namespace jci\Doctrine\Proxies\__CG__;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Field extends \Field implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function getChildren()
    {
        $this->__load();
        return parent::getChildren();
    }

    public function addChild(\Field $child)
    {
        $this->__load();
        return parent::addChild($child);
    }

    public function removeChild(\Field $child)
    {
        $this->__load();
        return parent::removeChild($child);
    }

    public function removeChildById($id)
    {
        $this->__load();
        return parent::removeChildById($id);
    }

    public function addUser(\User $user)
    {
        $this->__load();
        return parent::addUser($user);
    }

    public function removeUser(\User $user)
    {
        $this->__load();
        return parent::removeUser($user);
    }

    public function setParent(\Field $parent = NULL)
    {
        $this->__load();
        return parent::setParent($parent);
    }

    public function getParent()
    {
        $this->__load();
        return parent::getParent();
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

    public function __toString()
    {
        $this->__load();
        return parent::__toString();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'name', 'children', 'parent', 'users', 'donations');
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