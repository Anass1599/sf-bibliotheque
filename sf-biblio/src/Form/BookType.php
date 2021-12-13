<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Gener;
use phpDocumentor\Reflection\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('nbPages')
            ->add('publishedAt', DateType::class, [
                'widget' => 'single_text',
            ])
            //avec add je cree un input qui recupere l'entity Author
                //avec choice_label je cible l'information a afficher
                //ici avec une fonction je concatène firtName et lastName.
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label'  => function ($author) {
                    return $author->getfirtName() . ' ' . $author->getlastName();
                }
            ])
            // Ajouter un input submit
            ->add('gener', EntityType::class, [
                'class' => Gener::class,
                'choice_label' => 'title',
            ])
            ->add('VALIDER', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
