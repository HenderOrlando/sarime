<?php

namespace Sirepae\PAEBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PAEType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('paciente')
            ->add('estudiante')
            ->add('val_objetiva')
            ->add('val_subjetiva')
            ->add('evaluacion')
            ->add('objetivo')
            ->add('calificacion', new CalificacionType())
        ;
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
