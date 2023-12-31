<?php

namespace App\Form;

use App\Entity\Book;
use App\Form\BookType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Author;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref')
            ->add('title')
           #->add('published') na7eha bech naamil condition fil add published dima true
            ->add('publicationDate')
            ->add('category')
            ->add('author')
            /*  ->add('author', EntityType::class,[
           'choice_label'=>'username',
           'class'=>Author::class,
           'required'=>True])*/
            ->add('save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }

}
