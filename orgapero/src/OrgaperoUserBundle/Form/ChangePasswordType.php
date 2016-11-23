<?php
/**
 * Created by PhpStorm.
 * User: Ludovic Sire
 * Date: 23/11/2016
 * Time: 13:48
 */
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', TextType::class)
            ->add('newPassword', RepeatedType::class,
                array(
                    'type' => TextType::class,
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OrgaperoUserBundle\Entity\ChangePassword'
        ));
    }
}
