<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistroEnfermeriaType extends AbstractType
{
    private $estudiante;
    
    public function __construct(\Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante $estudiante = null){
        $this->estudiante = $estudiante;
    }
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('paciente', null, array(
                'empty_value'  =>  'Elija un paciente',
//                'empty_data'   =>  '-1'
            ));
        if(!is_null($this->estudiante)){
            $builder->add('estudiante',null, array(
                'label' => false,
                'data' => $this->estudiante,
                'attr' => array('class' => 'hide'),
            ));
        }else{
            $builder->add('estudiante');
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_registrosenfermeriabundle_registroenfermeria';
    }
}
