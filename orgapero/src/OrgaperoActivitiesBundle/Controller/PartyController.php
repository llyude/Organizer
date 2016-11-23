<?php

namespace OrgaperoActivitiesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartyController extends Controller
{
    public function newPartyAction()
    {
        return $this->render('OrgaperoActivitiesBundle:Party:new_party.twig.html', array(
            )
        );
    }
}
