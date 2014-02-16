<?php

namespace Sirepae\PAEBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PAEType extends AbstractType
{
    private $pae;
    private $usuario;
    
    public function __construct(\Sirepae\PAEBundle\Entity\PAE $pae = null, \Sirepae\UsuariosBundle\Entity\Usuario $usuario = null) {
        $this->pae = $pae;
        $this->usuario = $usuario;
    }
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($this->usuario->hasRole('ROLE_DOCENTE')){
            $builder->add('calificacion', new CalificacionType($this->pae,  $this->usuario));
        }elseif($this->usuario->hasRole('ROLE_ESTUDIANTE') && (is_null($this->pae) || !is_null($this->pae->getCalificacion()) || !$this->pae->getCalificacion())){
            $builder
                ->add('paciente')
                ->add('estudiante',null, array(
                    'label' => false,
                    'data' => $this->usuario->getEstudiantes(),
                    'attr' => array('class' => 'hide'),
                ))
                ->add('objetivo')
                ->add('val_objetiva',NULL,array(
                    'label' =>  'Valoración Objetiva'
                ))
                ->add('val_subjetiva',NULL,array(
                    'label' =>  'Valoración Subjetiva'
                ))
                ->add('evaluacion');
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\PAEBundle\Entity\PAE'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_paebundle_pae';
    }
}
