<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;


class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le champs doit comporter au moins {{ limit }} caractères',
                    ]),
                ],
            ])
            // en mettant NumberType::class ca nous oblige à entrer des chiffres et non des lettres
            ->add('card_number', TextType::class, [

                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d{4}\s?\d{4}\s?\d{4}\s?\d{4}$/', //vérifie si la chaîne est composée de  4 chiffres séparées par un espace
                        'message' => 'Le format du numéro de carte bancaire est invalide. Veuillez saisir 16 chiffres.',
                    ]),
                ],
                'attr' => [
                    'maxlength' => 19, // La longueur maximale dans le champs sera de 16 chiffres plus les 3 espaces
                    'oninput' => 'addSpace(event)',
                ],
            ])
            ->add('date_expiration', TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d{2}\/\d{2}$/', // vérifie si la chaîne est composée de deux paires de chiffres séparées par un slash
                        'message' => 'La date d\'expiration doit comporter 4 chiffres']),
                ],
                'attr' => [
                    'maxlength' => 5,
                    'oninput' => 'addSlash(event)',
                ],
            ])
            ->add('CVV', TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d{3}$/', // vérifie si la chaîne est composée de 3 chiffres
                        'message' => 'Le cryptogramme doit comporter 3 chiffres']),
                ],
                'attr' => [
                    'maxlength' => 3,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            
        ]);
    }
}
