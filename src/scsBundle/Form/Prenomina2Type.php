<?php

namespace scsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Prenomina2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prenominaTrabajador', 'collection', array('type'=>new PrenominaTrabajadorType()));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        {
            $resolver->setDefaults(array(
                'data_class' => 'scsBundle\Entity\Prenomina',));
        }
    }

    public function getName()
    {
        return 'scs_bundle_prenomina2type';
    }
}
