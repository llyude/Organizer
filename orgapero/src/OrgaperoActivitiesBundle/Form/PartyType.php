<?php

namespace OrgaperoActivitiesBundle\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use OrgaperoActivitiesBundle\Entity\Activity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartyType extends AbstractType
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * PartyType constructor.
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


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
            ->add('listActivitiesTemp', EntityType::class, array(
                'class' => 'OrgaperoActivitiesBundle:TypeOfActivity',
                'choice_label' => 'name',
                'attr' => array('class', 'input-field'),
                'multiple' => true,
                'mapped' => false
            ))
            ->add('listActivities', EntityType::class, array(
                'class' => 'OrgaperoActivitiesBundle\Entity\Activity',
                'choice_label' => 'typeofactivity',
                'attr' => array('class', 'input-field'),
                'multiple' => true,
                'required'    => false,
            ))
            ->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmitData'))
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

    public function onPreSubmitData(FormEvent $event)
    {
        $party = $event->getData();
        if (!$party) {
            return;
        }
        $typeOfActivityRepo = $this->em->getRepository('OrgaperoActivitiesBundle:TypeOfActivity');
        $listTypeOfActivity = $typeOfActivityRepo->findBy(array('id' => $party['listActivitiesTemp']));
        $activity = new ArrayCollection();

        if (!empty($listTypeOfActivity)) {
            foreach ($listTypeOfActivity as $typeOfActivity) {
                $activity->add(Activity::createActivity($typeOfActivity)) ;
            }
            $event->setData($activity);
        } else {

        }

    }

}
