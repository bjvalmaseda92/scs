<?php

namespace scsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('usuario')
            ->add('correo')
            ->add('rol', 'choice', array(
                'choices' => array('ROLE_ADMIN' => 'Administrador','ROLE_TECNICO'=>'Técnico')
            ))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las contraseñas deben coincidir.',
                'options' => array('attr' => array('class' => 'form-control')),
                'required' => true,
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Confirmar contraseña'),
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'scsBundle\Entity\Usuario'
        ));
    }
}
