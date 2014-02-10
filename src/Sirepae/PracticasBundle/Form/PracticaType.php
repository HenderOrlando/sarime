<?php

namespace Sirepae\PracticasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PracticaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('areaPractica')
            ->add('docente', null, array(
                'class' => 'SirepaeUsuariosBundle:Usuario',
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('u')->leftJoin('u.rol_usuario', 'r')
                            ->andWhere('r.nombre LIKE \'%docente%\'');
                },
            ))
            ->add('coordinador', null, array(
                'class' => 'SirepaeUsuariosBundle:Usuario',
                'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('u')->leftJoin('u.rol_usuario', 'r')
                            ->andWhere('r.nombre LIKE \'%coordinador%\'');
                },
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirepae\PracticasBundle\Entity\Practica'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirepae_practicasbundle_practica';
    }
}
