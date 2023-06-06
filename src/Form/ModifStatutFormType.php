<?php

namespace App\Form;

use App\Entity\Statut;
use App\Entity\StatutType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifStatutFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isFavoris', CheckboxType::class, [
                'label' => 'Favoris : ',
                'required' => false,
            ])
            ->add('episodes_vus', IntegerType::class, [
                'label' => 'Episodes vus : ',
            ])
            ->add('statutType', EntityType::class, [
                'class' => StatutType::class,
                'choice_label' => 'label',
                'label' => 'Statut : ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Statut::class,
        ]);
    }
}
