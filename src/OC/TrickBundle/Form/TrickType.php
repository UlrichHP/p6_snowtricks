<?php

namespace OC\TrickBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',           TextType::class)
            ->add('description',    TextareaType::class)
            ->add('category',       EntityType::class, array(
                'class'         =>  'OCTrickBundle:Category',
                'choice_label'  =>  'name',
                'multiple'      =>  false
            ))
            ->add('pictures',       CollectionType::class, array(
                'entry_type'    =>  PictureType::class,
                'allow_add'     =>  true,
                'allow_delete'  =>  true,
                'by_reference'  =>  false,
                'label'         =>  false,
            ))
            ->add('videos',         CollectionType::class, array(
                'entry_type'    =>  VideoType::class,
                'allow_add'     =>  true,
                'allow_delete'  =>  true,
                'by_reference'  =>  false,
                'label'         =>  false,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\TrickBundle\Entity\Trick'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_trickbundle_trick';
    }


}
