<?php

namespace OrgaperoActivitiesBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use OrgaperoUserBundle\Entity\User;

/**
 * Party
 */
class Party
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $time;

    /**
     * @var string
     */
    private $location;

    /**
     * @var User
     */
    private $organizer;

    /**
     * @var ArrayCollection
     */
    private $listParticipants;

    /**
     * @var ArrayCollection
     */
    private $listActivities;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Party
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Party
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Party
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return User
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * @param User $organizer
     */
    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;
    }

    /**
     * @return ArrayCollection
     */
    public function getListParticipants()
    {
        return $this->listParticipants;
    }

    /**
     * @param ArrayCollection $listParticipants
     */
    public function setListParticipants($listParticipants)
    {
        $this->listParticipants = $listParticipants;
    }

    /**
     * @return ArrayCollection
     */
    public function getListActivities()
    {
        return $this->listActivities;
    }

    /**
     * @param ArrayCollection $listActivities
     */
    public function setListActivities($listActivities)
    {
        $this->listActivities = $listActivities;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }



}

