<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserFormType extends AbstractType
{
    private const INPUT_STYLE = 'form-control';
    private const LABEL_STYLE = 'form-label mt-3 fw-bold text-dark';
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Name:',
                'required' => false,
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_name',
                    'placeholder' => 'Write your name here',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'This field can not be blank']),
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Lastname',
                'required' => false,
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_lastname',
                    'placeholder' => 'Write your lastname here',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'This field can not be blank']),
                ]
            ])
            ->add('email', TextType::class, [
                'label' => 'Email:',
                'required' => false,
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_email',
                    'placeholder' => 'Write your email here',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'This field can not be blank']),
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone:',
                'required' => false,
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_phone',
                    'placeholder' => 'Write your number phone number here',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Este campo no puede estar vacío']),
                    new Regex([
                        'pattern' => '/^\d{10}$/',
                        'message' => 'Este campo no puede contener letras y debe contener solo 10 dígitos'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
