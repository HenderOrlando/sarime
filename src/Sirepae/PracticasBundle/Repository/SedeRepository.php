<?php
namespace Sirepae\PracticasBundle\Repository;
use Doctrine\ORM\EntityRepository;

class SedeRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaePracticasBundle:Sede p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}