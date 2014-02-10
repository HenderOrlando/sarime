<?php
namespace Sirepae\PracticasBundle\Repository;
use Doctrine\ORM\EntityRepository;

class PracticaRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaePracticasBundle:Practica p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}