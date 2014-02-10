<?php
namespace Sirepae\PracticasBundle\Repository;
use Doctrine\ORM\EntityRepository;

class AreaRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaePracticasBundle:Area p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}