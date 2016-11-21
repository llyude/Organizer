<?php

namespace OrgaperoUserBundle\Controller;

use OrgaperoUserBundle\Entity\User;
use OrgaperoUserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;

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
            'error' => $error,
        ));
    }

    public function lostPasswordAction()
    {

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

    public function profileAction(UserInterface $user = null)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('OrgaperoUserBundle:User:profile.html.twig');
    }


    public function addFriendAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class, array('attr'=> array('placeholder' => 'Enter a username')))
            ->add('find', SubmitType::class, array('label' => 'Find my friend', 'attr' => array('class' => 'btn')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userSearched = $form->get('username')->getData();

            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('OrgaperoUserBundle:User')->findBy(
                array('username' => $userSearched)
            );

            $addFriendForm = $this->createFormBuilder($user)
                ->add('id', HiddenType::class)
                ->add('addNewFriend', SubmitType::class, array('label' => '', 'attr' => array('class' => 'secondary-content btn-floating btn-large waves-effect waves-light')))
                ->getForm();

            if ($addFriendForm->isSubmitted() && $addFriendForm->isValid()) {
                $friendId = $addFriendForm->get('id')->getData();

                $user->setFriendsWithMe($friendId);
                return $this->render('OrgaperoUserBundle:User:addFriend.html.twig', array(
                    'users' => $users, 'form' => $form->createView()));
            }


            return $this->render('OrgaperoUserBundle:User:addFriend.html.twig', array(
                'users' => $users, 'form' => $form->createView(), 'addFriend' => $addFriendForm->createView() ));

        }

        
        return $this->render('OrgaperoUserBundle:User:addFriend.html.twig', array(
            'form' => $form->createView()));
    }


}
