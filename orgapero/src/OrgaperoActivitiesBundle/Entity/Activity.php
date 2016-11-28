<?php

namespace OrgaperoActivitiesBundle\Entity;

use Foo\Bar\A;
use OrgaperoContributionsBundle\Entity\Contribution;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Activity
 */
abstract class Activity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Party
     */
    protected $party;

    /**
     * @var TypeOfActivity
     */
    protected $typeOfActivity;

    /**
     * @var Contribution
     */
    protected $listContributions;

    /**
     * @var DateTime
     */
    protected $date;

    public static function createActivity(TypeOfActivity $typeOfActivity)
    {
        // TODO vérifier que la class créée est bien une instanceof Activity
        // sous typage
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

class Diner extends Activity
{
    protected static $name = 'Dîner';
}


class Bowling extends Activity
{
    protected static $name = "Bowling";
}
