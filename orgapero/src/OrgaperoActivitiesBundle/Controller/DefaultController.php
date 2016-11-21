<?php

namespace OrgaperoActivitiesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OrgaperoActivitiesBundle:Default:index.html.twig');
    }
}
