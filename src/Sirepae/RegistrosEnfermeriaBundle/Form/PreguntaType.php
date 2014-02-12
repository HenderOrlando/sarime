<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreguntaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enunciado')
            ->add('ayuda')
            ->add('registro')
            ->add('orden')
            ->add('multi_rta')
            ->add('expandido')
            ->add('requerido')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_registrosenfermeriabundle_pregunta';
    }
}
