<?php

namespace Sirepae\PAEBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClaseType extends AbstractType
{
    private $nanda;
    
    public function __construct(\Sirepae\PAEBundle\Entity\NANDA $nanda = null) {
        $this->nanda = $nanda;
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
        $opts = array();
        if(!is_null($this->nanda)){
            $opts = array(
                'class' => 'SirepaePAEBundle:Dominio',
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('d')
                           ->andWhere('d.NANDA = '.$this->nanda->getId());
                    }
                );
            }
        $builder->add('dominio', null, $opts);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\PAEBundle\Entity\Clase'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_paebundle_clase';
    }
}
