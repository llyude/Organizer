<?php

namespace OrgaperoActivitiesBundle\Form;

use OrgaperoActivitiesBundle\Entity\TypeOfActivity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeOfActivityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('parent', EntityType::class, array(
                'class' => 'OrgaperoActivitiesBundle:TypeOfActivity',
                'choice_label' => 'name',
                'preferred_choices' => array('Aucun')
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OrgaperoActivitiesBundle\Entity\TypeOfActivity'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'orgaperoactivitiesbundle_typeofactivity';
    }


}
