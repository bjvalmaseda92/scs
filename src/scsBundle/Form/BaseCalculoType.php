<?php

namespace scsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaseCalculoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('mes', 'choice', array(
            'choices' => array(
                '01' => 'Enero',
                '02' => 'Febrero',
                '03'=>'Marzo',
                '04' => 'Abril',
                '05' => 'Mayo',
                '06' => 'Junio',
                '07' => 'Julio',
                '08' => 'Agosto',
                '09' => 'Septiembre',
                '10' => 'Octubre',
                '11' => 'Noviembre',
                '12' => 'Diciembre',
            )
        ))
            ->add('anno','choice', array(
                'choices' => array(
                    '2015'=>'2015',
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019',
                    '2020'=>'2020',
                    '2021'=>'2021',
                    '2022'=>'2022',
                    '2023'=>'2023',
                    '2024'=>'2024',
                    '2025'=>'2025',
                )
            ))
            ->add('taller')
            ->add('rendimiento')
            ->add('maestria')
            ->add('otros')
            ->add('fondo');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'scsBundle\Entity\BaseCalculo'
        ));
    }

    public function getName()
    {
        return 'scs_bundle_base_calculo_type';
    }
}
