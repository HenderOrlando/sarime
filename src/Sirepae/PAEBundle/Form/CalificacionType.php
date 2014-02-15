<?php

namespace Sirepae\PAEBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CalificacionType extends AbstractType
{
    private $pae;
    private $usuario;
    
    public function __construct(\Sirepae\PAEBundle\Entity\PAE $pae = NULL, \Sirepae\UsuariosBundle\Entity\Usuario $usuario) {
        $this->pae = $pae;
        $this->usuario = $usuario;
    }
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valor',null,array(
                'label' =>  'Nota'
            ))
            ->add('observacion',null,array(
                'label' =>  'Observaciones'
            ))
//            ->add('PAE')
//            ->add('docente')
        ;
        if(!is_null($this->pae)){
            $builder->add('PAE',null, array(
                'label' => false,
                'data' => $this->pae,
                'attr' => array('class' => 'hide'),
            ));
        }else{
            $builder->add('PAE');
        }
        if(!is_null($this->usuario)){
            $builder->add('docente',null, array(
                'label' => false,
                'data' => $this->usuario,
                'attr' => array('class' => 'hide'),
            ));
        }else{
            $builder->add('PAE');
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\PAEBundle\Entity\Calificacion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_paebundle_calificacion';
    }
}
