<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstudianteType extends AbstractType
{
    private $rol;
    
    public function __construct(\Sirepae\UsuariosBundle\Entity\Rol $rol = null) {
        $this->rol = $rol;
    }
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usuario', new \Sirepae\UsuariosBundle\Form\UsuarioType($this->rol), array(
                'label' =>  'Datos de Usuario'
            ))
            ->add('codigo')
            ->add('semestre')
            ->add('practica')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_registrosenfermeriabundle_estudiante';
    }
}
