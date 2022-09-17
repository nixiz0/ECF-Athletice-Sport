<?php

namespace App\Form;

use App\Entity\FranchiseMain;
use App\Entity\Option;
use App\Entity\StructureMain;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StructureMainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('IsActive', CheckboxType::class, [
            'label' => 'Actif',
            'required' => false,
            'attr' => [
                'class' => 'form-check-input',
            ],
        ])

        ->add('options', EntityType::class, [
            'class' => Option::class,
            'label' => 'Les Options de la structure',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'choice_label' => 'NameOption',
            'multiple' => true,
            'expanded' => true,
        ])
        ->add('user', EntityType::class, [
            'required' => false,
            'class' => User::class,
            'choice_label'=>function($email){
            return $email->getEmail();
        },
        'label' => 'Merci de vérifier que c\'est bien votre email ',
            'attr' => [
                'class' => 'form-control '
            ],
            'placeholder'=>'Choisissez votre email dans la liste',

        ])

        ->add('FranchiseMain', EntityType::class, [
            'required' => false,
            'class' => FranchiseMain::class,
            'attr' => [
                'class' => 'select2'
            ],
            'label' => 'Veuillez sélectionner le franchisé adéquat avec la structure'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StructureMain::class,
        ]);
    }
}
