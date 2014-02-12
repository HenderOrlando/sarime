<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Repository;
use Doctrine\ORM\EntityRepository;

class OpcionRespuestaRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta p ORDER BY p.name ASC'
            )
            ->getResult();
    }
    public function findArrayAll()
    {
        $q = $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta p ORDER BY p.id ASC'
            )
            ->getArrayResult();
        $a = array();
        foreach($q as $b)
            $a[$b['id']] = $b;
        return $a;
    }
}