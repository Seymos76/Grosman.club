<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'gender',
                ChoiceType::class,
                array(
                    'choices' => array(
                        'Monsieur' => "sir",
                        'Madame' => "miss",
                        'Autre' => "other"
                    )
                )
            )
            ->add(
                'firstname',
                TextType::class
            )
            ->add(
                'lastname',
                TextType::class
            )
            ->add(
                'birthdate',
                DateType::class,
                array(
                    'label' => "Ta date de naissance",
                    'attr' => array(
                        'format' => DateType::HTML5_FORMAT
                    )
                )
            )
            ->add(
                'email',
                EmailType::class
            )
            ->add(
                'password',
                PasswordType::class
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
