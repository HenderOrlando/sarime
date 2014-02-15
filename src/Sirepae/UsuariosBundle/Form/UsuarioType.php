<?php

namespace Sirepae\UsuariosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    private $rol;
    private $usuario;
    
    public function __construct(\Sirepae\UsuariosBundle\Entity\Rol $rol = null, \Sirepae\UsuariosBundle\Entity\Usuario $usuario = null) {
        $this->rol = $rol;
        $this->usuario = $usuario;
    }
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',null, array('label' => 'Nombre de Usuario'))
            ->add('email',null, array('label' => 'Correo electrónico'))
            ->add('enabled',null, array('label' => 'Habilitar', 'data' => true))
//            ->add('locked',null, array('label' => 'Bloquear'))
//            ->add('expired',null, array('label' => 'Expirar'))
//            ->add('roles')
            ->add('nombres',null, array('label' => 'Nombres Completo'))
            ->add('apellidos',null, array('label' => 'Apellidos Completos'))
            ->add('telefonos')
            ->add('direccion')
//            ->add('estudiantes')
        ;
        if(!is_null($this->rol)){
            $builder->add('rol_usuario',null, array(
                'label' => false,
                'data' => $this->rol,
                'attr' => array('class' => 'hide'),
            ));
        }elseif(!is_null($this->usuario)){
            if($this->usuario->hasRole('ROLE_COORDINADOR')){
                $builder->add('rol_usuario');
            }
        }else{
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\UsuariosBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_usuariosbundle_usuario';
    }
}
