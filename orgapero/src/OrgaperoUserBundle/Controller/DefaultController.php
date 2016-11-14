<?php

namespace OrgaperoUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OrgaperoUserBundle:Default:index.html.twig');
    }
}
