<?php

namespace App\Form;

use App\Entity\Anime;
use App\Data\SearchData;
use App\Repository\AnimeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('genres', EntityType::class, [
                'class' => Anime::class,
                'required' => false,
                'label' => false,
                'expanded' => false,
                // 'choice_label' => function(Anime $anime) {
                //     return $anime->getGenre()->getLibelle();
                // }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix() {
        return '';
    }
}
