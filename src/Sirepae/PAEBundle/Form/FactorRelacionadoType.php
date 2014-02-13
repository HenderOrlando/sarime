<?php

namespace Sirepae\PAEBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FactorRelacionadoType extends AbstractType
{
    private $clase;
    
    public function __construct(\Sirepae\PAEBundle\Entity\Clase $clase = null) {
        $this->clase = $clase;
    }
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
         ;
        $opts = array(
            'label' => false,
            'attr' => array('class' => 'hide'),
        );

        if(!is_null($this->clase)){
            $opts = array(
                'class' => 'SirepaePAEBundle:Diagnostico',
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                           ->andWhere('c.clase = '.$this->clase->getId());
                    }
                );
            }
        $builder->add('diagnostico', null, $opts);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\PAEBundle\Entity\FactorRelacionado'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_paebundle_factorrelacionado';
    }
}
