<?php

namespace OrgaperoPageBundle\Controller;

use OrgaperoPageBundle\Entity\Contact;
use OrgaperoPageBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OrgaperoPageBundle:Default:index.html.twig');
    }

    public function legalsAction()
    {
        return $this->render('OrgaperoPageBundle:Page:legal.html.twig');
    }

    public function contactAction(Request $request)
    {
        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            
            $message = \Swift_Message::newInstance()
                ->setSubject($contactForm->get('subject')->getData())
                ->setFrom($contactForm->get('email')->getData())
                ->setTo('ludovic.sire@gmail.com')
                ->setBody(
                    $this->renderView(
                        'Emails/contactMail.html.twig',
                        array('name' => $contactForm->get('name')->getData(),
                            'message' => $contactForm->get('message')->getData())
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            $mailvalidation = 'Le mail a bien été envoyé, merci!';
            return $this->render('OrgaperoPageBundle:Page:contact.html.twig', array('contactForm' => $contactForm->createView(), 'info' => $mailvalidation));
        }


        return $this->render('OrgaperoPageBundle:Page:contact.html.twig', array('contactForm' => $contactForm->createView(),));
    }
}
