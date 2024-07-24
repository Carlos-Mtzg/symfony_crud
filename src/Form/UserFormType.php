<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserFormType extends AbstractType
{
    private const INPUT_STYLE = 'form-control';
    private const LABEL_STYLE = 'form-label mt-3 fw-bold text-dark';
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nombre:',
                'required' => $options['is_edit'] ? true : false,
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_name',
                    'placeholder' => 'Escribe tu nombre aquí',
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Apellido',
                'required' => $options['is_edit'] ? true : false,
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_lastname',
                    'placeholder' => 'Escribe tu apellido aquí',
                ]
            ])
            ->add('email', TextType::class, [
                'label' => 'Correo Electrónico:',
                'required' => $options['is_edit'] ? true : false,
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_email',
                    'placeholder' => 'Escribe tu correo electrónico aquí',
                ],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Teléfono:',
                'required' => $options['is_edit'] ? true : false,
                'label_attr' => [
                    'class' => self::LABEL_STYLE
                ],
                'attr' => [
                    'class' => self::INPUT_STYLE,
                    'id' => 'user_form_phone',
                    'placeholder' => 'Escribe tu número de teléfono aquí',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'is_edit' => false,
        ]);
    }
}
