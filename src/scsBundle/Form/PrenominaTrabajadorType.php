<?php

namespace scsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrenominaTrabajadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('trabajadores')
            ->add('salario_devengado', 'text', array(
                'attr'=>(array('class'=>'form-control money')
                )))
            ->add('maestria', 'text', array(
                'attr'=>(array('class'=>'form-control money')
                )))
            ->add('interrupciones', 'text', array(
                'attr'=>(array('class'=>'form-control money')
                )))
            ->add('instructor', 'text', array(
                'attr'=>(array('class'=>'form-control money')
                )))
            ->add('dia_feriado', 'text', array(
                'attr'=>(array('class'=>'form-control money')
                )))
            ->add('horas_extras', 'text', array(
                'attr'=>(array('class'=>'form-control money')
                )))
            ->add('penalizacion', 'text', array(
                'attr'=>(array('class'=>'form-control')
                ),
                'required'=>false
            ))
            ->add('vacaciones', 'text', array(
                'attr'=>(array('class'=>'form-control money')
                )))
            ->add('indice_evaluacion', 'text', array(
                'attr'=>(array('class'=>'form-control money')
                )))
            ->add('movilizacion', 'text', array(
                'attr'=>(array('class'=>'form-control money')
                )));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        {
            $resolver->setDefaults(array(
                'data_class' => 'scsBundle\Entity\PrenominaTrabajador',));
        }
    }

    public function getName()
    {
        return 'scs_bundle_prenomina_trabajador_type';
    }
}
