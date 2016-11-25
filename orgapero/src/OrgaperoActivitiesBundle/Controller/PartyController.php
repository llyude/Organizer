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
            $time = $partyForm->get('time')->getData();
            $datetime = $date . $time;
            $date = \DateTime::createFromFormat('d F, Y H:i', $datetime);
            $party->setDate($date);
            $em = $this->getDoctrine()->getManager();
            $em->persist($party);
            $em->flush();

            // redirect to a add friend to the party with parameters
            return $this->redirectToRoute('orgapero_invite_friends', array('party' => $party));
        }
        return $this->render('OrgaperoActivitiesBundle:Party:new_party.twig.html', array('form' => $partyForm->createView(),)
        );
    }


    public function inviteFriendsAction(Request $request, Party $party)
    {

        $inviteFriendsForm = $this->createForm(InviteFriendsType::class, $party);
        $inviteFriendsForm->handleRequest($request);

        if ($inviteFriendsForm->isSubmitted() && $inviteFriendsForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($party);
            $em->flush();

        }

        return $this->render('OrgaperoActivitiesBundle:Party:new_party.twig.html', array('form' => $inviteFriendsForm->createView(),)
        );
    }


}
