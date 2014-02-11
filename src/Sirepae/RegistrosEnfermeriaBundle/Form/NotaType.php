<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NotaType extends AbstractType
{
    private $re;
    
    public function __construct(\Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria $re = null) {
        $this->re = $re;
    }
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nota')
//            ->add('registroEnfermeria')
        ;
        if(!is_null($this->re)){
            $builder->add('registroEnfermeria',null, array(
                'label' => false,
                'data' => $this->re,
                'attr' => array('class' => 'hide'),
            ));
        }else
            $builder->add('registroEnfermeria');

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\RegistrosEnfermeriaBundle\Entity\Nota'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_registrosenfermeriabundle_nota';
    }
}
