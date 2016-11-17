<?php

namespace OrgaperoUserBundle\Controller;

use OrgaperoUserBundle\Entity\User;
use OrgaperoUserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserController extends Controller
{
    public function loginAction()
    {

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('OrgaperoUserBundle:User:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    public function registerAction(Request $request)
    {

        $user = new User();
        $form = $this->get('form.factory')->create(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                             ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('orgapero_user_profile', array('id' => $user->getId()));
        }

        return $this->render('OrgaperoUserBundle:User:register.html.twig', array(
                'form' => $form->createView(),)
        );
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OrgaperoUserBundle/Entity/User'
        ));
    }

    public function profileAction()
    {
        return $this->render('OrgaperoUserBundle:User:profile.html.twig');
    }

}
