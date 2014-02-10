<?php
namespace Sirepae\UsuariosBundle\Repository;
use Doctrine\ORM\EntityRepository;

class RolRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaeUsuariosBundle:Rol p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}