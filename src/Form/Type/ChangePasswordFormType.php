<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

/**
 * ChangePasswordFormType class
 *
 */
class ChangePasswordFormType extends AbstractType
{

    /**
     * Build the form
     *
     *
     * @param FormBuilderInterface $builder The form builder interface.
     * @param array $options An array of options for the form.
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('plainPassword', PasswordType::class, [
            'label' => 'New password',
            'mapped' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    'max' => 4096,
                ]),
            ],
        ]);
    }

    /**
     * Configure options
     *
     *
     * @param OptionsResolver $resolver The options resolver.
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
