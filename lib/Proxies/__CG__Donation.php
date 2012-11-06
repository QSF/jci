<?php

namespace jci\Doctrine\Proxies\__CG__;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Donation extends \Donation implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function beforePersist()
    {
        $this->__load();
        return parent::beforePersist();
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

    public function setDate($date)
    {
        $this->__load();
        return parent::setDate($date);
    }

    public function getDate()
    {
        $this->__load();
        return parent::getDate();
    }

    public function setFeedBackVolunteer($feedBackVolunteer)
    {
        $this->__load();
        return parent::setFeedBackVolunteer($feedBackVolunteer);
    }

    public function getFeedBackVolunteer()
    {
        $this->__load();
        return parent::getFeedBackVolunteer();
    }

    public function setDateFeedBackVolunteer($dateFeedBackVolunteer)
    {
        $this->__load();
        return parent::setDateFeedBackVolunteer($dateFeedBackVolunteer);
    }

    public function getDateFeedBackVolunteer()
    {
        $this->__load();
        return parent::getDateFeedBackVolunteer();
    }

    public function setFeedBackEntity($feedBackEntity)
    {
        $this->__load();
        return parent::setFeedBackEntity($feedBackEntity);
    }

    public function getFeedBackEntity()
    {
        $this->__load();
        return parent::getFeedBackEntity();
    }

    public function setDateFeedEntity($dateFeedBackEntity)
    {
        $this->__load();
        return parent::setDateFeedEntity($dateFeedBackEntity);
    }

    public function getDateFeedEntity()
    {
        $this->__load();
        return parent::getDateFeedEntity();
    }

    public function setVolunteer(\Volunteer $volunteer)
    {
        $this->__load();
        return parent::setVolunteer($volunteer);
    }

    public function getVolunteer()
    {
        $this->__load();
        return parent::getVolunteer();
    }

    public function setEntity(\Entity $entity)
    {
        $this->__load();
        return parent::setEntity($entity);
    }

    public function getEntity()
    {
        $this->__load();
        return parent::getEntity();
    }

    public function setModerator(\Moderator $moderator)
    {
        $this->__load();
        return parent::setModerator($moderator);
    }

    public function getModerator()
    {
        $this->__load();
        return parent::getModerator();
    }

    public function setField(\Field $field)
    {
        $this->__load();
        return parent::setField($field);
    }

    public function getField()
    {
        $this->__load();
        return parent::getField();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'date', 'feedBackVolunteer', 'dateFeedBackVolunteer', 'feedBackEntity', 'dateFeedBackEntity', 'volunteer', 'entity', 'moderator', 'field');
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