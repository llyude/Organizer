<?php

namespace OrgaperoActivitiesBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InviteFriendsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('time', TextType::class, array('attr' => array('placeholder' => 'ex: 20:00')))
            ->add('date', TextType::class, array('attr' => array('class' => 'partyDatepicker')))
            ->add('location', TextType::class)
            ->add('listActivities', EntityType::class, array(
                'class' => 'OrgaperoActivitiesBundle:Activity',
                /*'choice_label' => function($activity){
                    return $activity->getTypeOfActivity();
                },*/
                'attr' => array('class', 'input-field')
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(array('data_class' => 'OrgaperoActivitiesBundle\Entity\Party'));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'orgaperoactivitiesbundle_party';
    }


}
