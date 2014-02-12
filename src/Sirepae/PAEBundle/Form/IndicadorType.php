<?php

namespace Sirepae\PAEBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IndicadorType extends AbstractType
{
    private $noc;
    
    public function __construct(\Sirepae\PAEBundle\Entity\NOC $noc = null) {
        $this->noc = $noc;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('definicion')
            ->add('codigo')
        ;
        $opts = array();
        if(!is_null($this->noc)){
            $opts = array(
                'class' => 'SirepaePAEBundle:ResultadoEsperado',
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('re')
                           ->andWhere('re.NOC = '.$this->noc->getId());
                    }
                );
            }
        $builder->add('resultadoEsperado', null, $opts);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\PAEBundle\Entity\Indicador'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_paebundle_indicador';
    }
}
