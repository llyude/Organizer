<?php

namespace OrgaperoActivitiesBundle\Controller;

use OrgaperoActivitiesBundle\Entity\TypeOfActivity;
use OrgaperoActivitiesBundle\Form\TypeOfActivityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TypeOfActivityController extends Controller
{
    public function newTypeOfActivityAction(Request $request)
    {
        $activity = new TypeOfActivity();
        $form = $this->createForm(TypeOfActivityType::class, $activity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();
        }

        return $this->render('OrgaperoActivitiesBundle:TypeOfActivity:new_type_of_activity.twig.html', array(
                'form' => $form->createView(),)
        );

    }
}
