<?php
namespace Sirepae\UsuariosBundle\Repository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class UsuarioRepository extends EntityRepository implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        $q = $this
            ->createQueryBuilder('u')
            ->select('u, r')
            ->leftJoin('u.roles', 'r')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery();

        try {
            // The Query::getSingleResult() method throws an exception
            // if there is no record matching the criteria.
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            $message = sprintf(
                'Unable to find an active admin SirepaeUsuariosBundle:Usuario object identified by "%s".',
                $username
            );
            throw new UsernameNotFoundException($message, 0, $e);
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    $class
                )
            );
        }

        return $this->find($user->getId());
    }

    public function supportsClass($class)
    {
        return $this->getEntityName() === $class
            || is_subclass_of($class, $this->getEntityName());
    }
    
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaeUsuariosBundle:Usuario p ORDER BY p.name ASC'
            )
            ->getResult();
    }
    
    public function findAllDocentes()
    {
        return $this
                ->createQueryBuilder('u')
                ->leftJoin('u.rol_usuario', 'r')
                ->andWhere('r.nombre LIKE \'%docente%\'')
                ->getQuery()
                ->execute();
            ;
    }
    
    public function findAllDocentesAsignados()
    {
        return $this
                ->createQueryBuilder('u')
                ->innerJoin('u.docentesPractica','dp')
                ->groupBy('dp.id')
                ->getQuery()
                ->execute();
            ;
    }
    
    public function findAllCoordinadores($queryBuilder = false)
    {
        $q = $this
                ->createQueryBuilder('u')
                ->leftJoin('u.rol_usuario', 'r')
                ->andWhere('r.nombre LIKE \'%coordinador%\'');
            ;
        if($queryBuilder)
            return $q;
        return $q->getQuery()->execute();
    }
    
    public function findAllCoordinadoresAsignados($queryBuilder = false)
    {
        return $this
                ->createQueryBuilder('u')
                ->innerJoin('u.coordinadoresPractica','cp')
                ->groupBy('cp.id')
                ->getQuery()
                ->execute();
            ;
        if($queryBuilder)
            return $q;
        return $q->getQuery()->execute();
    }
}