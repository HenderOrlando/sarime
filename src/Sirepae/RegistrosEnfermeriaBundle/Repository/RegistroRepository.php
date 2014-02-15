<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Repository;
use Doctrine\ORM\EntityRepository;

class RegistroRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaeRegistrosEnfermeriaBundle:Registro p ORDER BY p.name ASC'
            )
            ->getResult();
    }       
    
    public function getRegistrosUsados(){
        $bundle = 'SirepaeRegistrosEnfermeriaBundle';
        return $this->getEntityManager()->createQuery(
                'SELECT r FROM '.$bundle.':Registro r'
                . ' INNER JOIN '.$bundle.':Pregunta p WITH r.id = p.registro INNER JOIN '.$bundle.':Respuesta rta WITH p.id = rta.pregunta'
                . ' GROUP BY p.registro'
            )->getResult();
    }
}