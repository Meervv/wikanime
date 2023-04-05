<?php

namespace App\Form;

use App\Entity\Anime;
use App\Entity\Genre;
use App\Entity\Type;
use App\Entity\Mangaka;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class AnimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, array(
                'label' => 'Titre : '
            ))
            ->add('image', TextType::class, array (
                'label' => 'Lien de l\'image : ',
                'required' => true
            ))
            ->add('synopsis', TextareaType::class, array(
                'label' => 'Synopsis : ',
                'required' => true
            ))
            ->add('note', NumberType::class, array(
                'label' => 'Note sur 5 : ',
                'required' => true
            ))
            ->add('nombreEpisodes', NumberType::class, array(
                'label' => 'Nombre d\'épisodes : ',
                'required' => true
            ))
            ->add('genre', EntityType::class, array(
                'class' => Genre::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.label', 'ASC');
                },
                'choice_label' => 'label',
            ))
            ->add('type', EntityType::class, array(
                'class' => Type::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.label', 'ASC');
                },
                'choice_label' => 'label',
            ))
            ->add('mangaka', EntityType::class, array(
                'class' => Mangaka::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->orderBy('m.nom, m.prenom', 'ASC');
                },
                'choice_label' => function(Mangaka $mangaka) {
                    return $mangaka->getNom() . ' ' . $mangaka->getPrenom();
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Anime::class,
        ]);
    }
}
