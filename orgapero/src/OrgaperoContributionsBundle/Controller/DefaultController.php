<?php

namespace OrgaperoContributionsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OrgaperoContributionsBundle:Default:index.html.twig');
    }
}
