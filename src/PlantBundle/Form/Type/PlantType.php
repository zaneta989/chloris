<?php

namespace PlantBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlantType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label'=>'plant_label.plant_name'))
            ->add('place', TextareaType::class, array(
                'label'=>'plant_label.plant_place',
                'required'=>false ))
            ->add('description', TextareaType::class, array(
                'label'=>'plant_label.plant_description',
                'required'=>false ))
            ->add('frequency', IntegerType::class, array(
                'label'=>'plant_label.plant_frequency'))
            ->add('isDaily', ChoiceType::class, array(
                'label'    => 'plant_label.plant_frequency_type',
                'choices'  => array(
                    'plant_label.plant_frequency_evry' => false,
                    'plant_label.plant_frequency_daily' => true)))
            ->add('amount', NumberType::class, array(
                'label'=>'plant_label.plant_amount'))
            ->add('dateLastWatered', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'label' => 'plant_label.plant_date_watered',
                ));
    }
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlantBundle\Entity\Plant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'plantbundle_plant';
    }
}

