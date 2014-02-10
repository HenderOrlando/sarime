<?php
namespace Sirepae\PracticasBundle\Repository;
use Doctrine\ORM\EntityRepository;

class MateriaRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaePracticasBundle:Materia p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}