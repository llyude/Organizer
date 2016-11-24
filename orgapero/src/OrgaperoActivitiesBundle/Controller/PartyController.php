<?php

namespace OrgaperoActivitiesBundle\Controller;

use OrgaperoActivitiesBundle\Entity\Party;
use OrgaperoActivitiesBundle\Form\PartyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PartyController extends Controller
{
    public function newPartyAction(Request $request)
    {
        $party = new Party();
        $partyForm = $this->createForm(PartyType::class, $party);

        $partyForm->handleRequest($request);

        if ($partyForm->isSubmitted() && $partyForm->isValid()) {
            $date = $partyForm->get('date')->getData();
            $date = str_replace(",", " ", $date);
            //$time = $partyForm->get('time')->getData();
            $date = date('d:m:Y' ,$date);
            $em = $this->getDoctrine()->getManager();
            $em->persist($party);
            $em->flush();
        }
        return $this->render('OrgaperoActivitiesBundle:Party:new_party.twig.html', array('form' => $partyForm->createView(),)
        );
    }
}
