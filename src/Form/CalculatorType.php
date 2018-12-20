<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class CalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('french', ChoiceType::class, [
                'choices'  => [
                    'Oui' => '1',
                    'Non' => '2',
                ],
                'expanded' => true,
                'multiple' => false,
                'label'  => 'Etes-vous de nationalité française ou membre de l\'Union Européenne:'
            ])
            ->add('adult', ChoiceType::class, [
                'choices'  => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10 ou plus' => '10',
                ],
                'expanded' => false,
                'multiple' => false,
                'label' => 'Nombre d\'adultes dans votre foyer:'
            ])
            ->add('child', ChoiceType::class, [
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10 ou plus' => '10',
                ],
                'expanded' => false,
                'multiple' => false,
                'label' => 'Nombre d\'enfants à charge:'
            ])
            ->add('revenue', TextType::class, ['label' => 'Revenu fiscal de référence:'])
            ->add('send', SubmitType::class, ['label' => 'Obtenir ma situation'])
        ;
    }
}