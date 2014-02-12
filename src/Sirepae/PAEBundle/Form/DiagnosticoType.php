<?php

namespace Sirepae\PAEBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DiagnosticoType extends AbstractType
{
    private $dominio;
    
    public function __construct(\Sirepae\PAEBundle\Entity\Dominio $dominio = null) {
        $this->dominio = $dominio;
    }
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('definicion')
        ;
        $opts = array();
        if(!is_null($this->dominio)){
            $opts = array(
                'class' => 'SirepaePAEBundle:Clase',
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('d')
                       ->andWhere('d.dominio = '.$this->dominio->getId());
                }
            );
        }
        $builder->add('clase', null, $opts);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\PAEBundle\Entity\Diagnostico'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_paebundle_diagnostico';
    }
}
