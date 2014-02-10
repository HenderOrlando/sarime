<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RespuestaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valor')
            ->add('fecha_creado')
            ->add('pacientes')
            ->add('registrosEnfermeria')
            ->add('pregunta')
            ->add('opcionRespuesta')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_registrosenfermeriabundle_respuesta';
    }
}
