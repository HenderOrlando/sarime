<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistroType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('tipo')
            ->add('unico', 'choice', array(
                'choices'   =>  array(true => 'Un solo Registro', false => 'Múltiples Registros'),
                'expanded'  =>  true,
                'multiple'  =>  false,
                'label'     =>  false,
            ))
            ->add('aplicaEnPaciente', 'choice', array(
                'label'     =>  false,
                'choices'   =>  array(true => 'Es Entrevista', false => 'Es Valoración'),
                'expanded'  =>  true,
                'multiple'  =>  false,
            ))
            ->add('tabla',null,array(
                'label' =>  'Ver como tabla'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\RegistrosEnfermeriaBundle\Entity\Registro'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_registrosenfermeriabundle_registro';
    }
}
