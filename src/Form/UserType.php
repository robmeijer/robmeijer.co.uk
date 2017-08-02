<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, ['label' => false, 'attr' => ['placeholder' => 'First Name']])
            ->add('surname', TextType::class, ['label' => false, 'attr' => ['placeholder' => 'Surname']])
            ->add('email', EmailType::class, ['label' => false, 'attr' => ['placeholder' => 'Email']])
            ->add('username', TextType::class, ['label' => false, 'attr' => ['placeholder' => 'Username']])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => false, 'attr' => ['placeholder' => 'Password']],
                'second_options' => ['label' => false, 'attr' => ['placeholder' => 'Repeat Password']],
            ])
	        ->add('save', SubmitType::class, ['label' => 'Register', 'attr' => ['class' => 'btn-primary btn-block btn-flat']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
