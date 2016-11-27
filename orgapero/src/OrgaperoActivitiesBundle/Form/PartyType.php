<?php

namespace OrgaperoActivitiesBundle\Form;

use OrgaperoActivitiesBundle\Repository\TypeOfActivityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartyType extends AbstractType
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
            ->add('listActivities', CollectionType::class, array(
                'entry_type' => EntityType::class,
                'entry_options' => function(){
                },
                'multiple'
            ))
//            for($i = 1; $i <= $this->course->getHolesNumber(); $i++) {
//                $hole = new Hole();
//                $hole->setCourse($this->course);
//                $hole->setNumber($i);
//                $builder->get('holes')->add('hole_'.$i, new HoleType($hole));
//            }
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();

                $activities = $data->getLi();

            })
            ->add('listParticipants', EntityType::class, array(
                'class' => 'OrgaperoUserBundle:User',
                'choice_label' => 'username',
                'attr' => array('class', 'input-field'),
                'multiple' => true,
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
