<?php
namespace Sirepae\PAEBundle\Repository;
use Doctrine\ORM\EntityRepository;

class CalificacionRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaePAEBundle:Clasificacion p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}