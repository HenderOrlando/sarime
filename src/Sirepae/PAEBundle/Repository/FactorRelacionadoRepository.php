<?php
namespace Sirepae\PAEBundle\Repository;
use Doctrine\ORM\EntityRepository;

class FactorRelacionadoRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaePAEBundle:FactorRelacionado p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}