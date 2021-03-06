<?php
namespace Sirepae\PAEBundle\Repository;
use Doctrine\ORM\EntityRepository;

class DiagnosticoRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaePAEBundle:Diagnostico p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}