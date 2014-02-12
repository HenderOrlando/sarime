<?php

namespace Sirepae\PAEBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActividadType extends AbstractType
{
    private $nic;
    
    public function __construct(\Sirepae\PAEBundle\Entity\NIC $nic = null) {
        $this->nic = $nic;
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
        if(!is_null($this->nic)){
            $opts = array(
                'class' => 'SirepaePAEBundle:Intervencion',
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('i')
                           ->andWhere('i.nic = '.$this->nic->getId());
                    }
                );
            }
        $builder->add('intervencion', null, $opts);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\PAEBundle\Entity\Actividad'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_paebundle_actividad';
    }
}
