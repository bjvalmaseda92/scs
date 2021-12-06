<?php

namespace scsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class CoeficienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mes', 'choice', array(
                'choices' => array(
                    'Enero' => 'Enero',
                    'Febrero' => 'Febrero',
                    'Marzo'=>'Marzo',
                    'Abril' => 'Abril',
                    'Mayo' => 'Mayo',
                    'Junio' => 'Junio',
                    'Julio' => 'Julio',
                    'Agosto' => 'Agosto',
                    'Septiembre' => 'Septiembre',
                    'Octubre' => 'Octubre',
                    'Noviembre' => 'Noviembre',
                    'Diciembre' => 'Diciembre',
                )
            ))
            ->add('ano','choice', array(
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
            ->add('cuc')
            ->add('cup')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'scsBundle\Entity\Coeficiente',
            'constraint'=>array(new Assert\Callback(array('scsBundle\Repository\Coeficiente',)))
        ));
    }
}
