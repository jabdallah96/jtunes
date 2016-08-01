<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;


class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('submit', SubmitType::class, array('label' => 'Search' , 'attr' => array('style' => 'width: 100px' )))
            ->add('search', TextType::class, (array('label' => 'Search songs: ' , 'attr' => array('style' => 'width: 210px'))
            ))
            ;
    }

}