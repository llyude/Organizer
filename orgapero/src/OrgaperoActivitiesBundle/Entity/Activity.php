<?php

namespace OrgaperoActivitiesBundle\Entity;
use OrgaperoContributionsBundle\Entity\Contribution;

/**
 * Activity
 */
class Activity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Party
     */
    private $party;

    /**
     * @var TypeOfActivity
     */
    private $typeOfActivity;

    /**
     * @var Contribution
     */
    private $listContributions;

    /**
     * Activity constructor.
     * @param TypeOfActivity $typeOfActivity
     * @param Party $party
     */
    public function __construct(TypeOfActivity $typeOfActivity)
    {
        $this->typeOfActivity = $typeOfActivity;
    }


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
     * @return Party
     */
    public function getParty()
    {
        return $this->party;
    }

    /**
     * @param Party $party
     */
    public function setParty($party)
    {
        $this->party = $party;
    }

    /**
     * @return TypeOfActivity
     */
    public function getTypeOfActivity()
    {
        return $this->typeOfActivity;
    }

    /**
     * @param TypeOfActivity $typeOfActivity
     */
    public function setTypeOfActivity($typeOfActivity)
    {
        $this->typeOfActivity = $typeOfActivity;
    }

    /**
     * @return Contribution
     */
    public function getListContributions()
    {
        return $this->listContributions;
    }

    /**
     * @param Contribution $listContributions
     */
    public function setListContributions($listContributions)
    {
        $this->listContributions = $listContributions;
    }
    
}

