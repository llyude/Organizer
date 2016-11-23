<?php

namespace OrgaperoUserBundle\Controller;

use OrgaperoUserBundle\Entity\ChangePassword;
use OrgaperoUserBundle\Entity\User;
use OrgaperoUserBundle\Form\EditProfileType;
use OrgaperoUserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends Controller
{
    /**
     * @return Response
     */
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

    public function lostPasswordAction(Request $request)
    {



    }
    public function changePasswordAction(Request $request)
    {
        $changePassword = new ChangePassword();
        /*$form = $this->get('form.factory')->create(\ChangePasswordType::class, $changePassword);
        $form->handleRequest($request);
         */
        return $this->render('OrgaperoUserBundle:User:changePassword.html.twig', array(
                )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
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

            return $this->redirectToRoute('orgapero_user_profile');
        }

        return $this->render('OrgaperoUserBundle:User:register.html.twig', array(
                'form' => $form->createView(),)
        );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OrgaperoUserBundle/Entity/User'
        ));
    }

    public function profileAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('OrgaperoUserBundle:User:profile.html.twig');
    }

    public function editProfileAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->get('form.factory')->create(EditProfileType::class, $user);
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

        return $this->render('OrgaperoUserBundle:User:edit_profile.html.twig',
            array('form' => $form->createView(),)
        );

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function searchFriendAction(Request $request)
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
                ->getForm();

            return $this->render('OrgaperoUserBundle:User:searchFriend.html.twig', array(
                'users' => $users, 'form' => $form->createView(), 'addFriend' => $addFriendForm->createView() ));
        }

        return $this->render('OrgaperoUserBundle:User:searchFriend.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     * @param integer $id
     * @return Response
     */
    public function addFriendAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $friend = $em->getRepository('OrgaperoUserBundle:User')->findBy(
            array('id' => $id)
        );

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user->addFriend($friend[0]);
        $em->flush();
        return $this->render('OrgaperoUserBundle:User:addFriend.html.twig', array(
            'test' => $friend));
        //return $this->redirectToRoute('orgapero_user_search_friend');
    }

    /**
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteFriendAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $friend = $em->getRepository('OrgaperoUserBundle:User')->findBy(
            array('id' => $id)
        );

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user->removeFriend($friend[0]);
        $em->flush();
        return $this->redirectToRoute('orgapero_user_profile');
    }

}

