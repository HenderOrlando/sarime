<?php
namespace Sirepae\PAEBundle\Repository;
use Doctrine\ORM\EntityRepository;

class DiagnosticoPAERepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaePAEBundle:DiagnosticoPAE p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}