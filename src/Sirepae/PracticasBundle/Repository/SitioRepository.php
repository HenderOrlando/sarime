<?php
namespace Sirepae\PracticasBundle\Repository;
use Doctrine\ORM\EntityRepository;

class SitioRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaePracticasBundle:Sitio p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}