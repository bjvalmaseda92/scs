<?php

namespace scsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrabajadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido1')
            ->add('apellido2')
            ->add('ci')
            ->add('direccion', 'textarea')
            ->add('departamento','text')
            ->add('escala')
            ->add('categoria')
            ->add('nombredepartamento');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'scsBundle\Entity\Trabajador'
        ));
    }

    public function getName()
    {
        return 'scs_bundle_trabajador';
    }
}
