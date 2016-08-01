<?php
/**
 * Created by PhpStorm.
 * User: jad
 * Date: 7/28/16
 * Time: 2:28 PM
 */

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\SongType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Album;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SongSingleType extends SongType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('album', EntityType::class, [
                'class' => Album::class,
                'choice_label' => 'name',
            ])
            ->add('submit', SubmitType::class, array('label' => 'Submit'))
            ;

        parent::buildForm($builder,$options);

    }
}