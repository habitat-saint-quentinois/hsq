<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;
use Vich\UploaderBundle\Form\Type\VichFileType;;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Un particulier' => 'particulier',
                    'Une collectivité' => 'collectivité',
                    'Un professionnel' => 'professionnel',
                ],
                'expanded' => true,
                'multiple' => false,
                'label'  => 'Vous êtes'
            ])
            ->add('civility', ChoiceType::class, [
                'choices'  => [
                    'Mme' => 'mme',
                    'Mlle' => 'mlle',
                    'Mr' => 'mr',
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Civilité'
            ])
            ->add('firstname', TextType::class, ['required' => false, 'label' => 'Prénom'])
            ->add('lastname', TextType::class, ['label' => 'Nom'])
            ->add('function', TextType::class, ['required' => false, 'label' => 'Fonction'])
            ->add('address', TextType::class, ['required' => false, 'label' => 'Adresse'])
            ->add('postcode', NumberType::class, ['required' => false, 'label' => 'Code Postal', 'attr' => ['maxlength' => 5]])
            ->add('city', TextType::class, ['required' => false, 'label' => 'Ville'])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('phone', TelType::class, ['label' => 'Téléphone', 'attr' => ['maxlength' => 10]])
            ->add('file', FileType::class, ['required' => false, 'label' => 'Piece Jointe'])
            ->add('message', TextareaType::class, ['required' => false, 'label' => 'Message'])
            ->add('recaptcha', EWZRecaptchaType::class, [
                'mapped' => false,
                'constraints' => [new RecaptchaTrue()],
            ])
            ->add('send', SubmitType::class, ['label' => 'Envoyer'])
        ;
    }
}