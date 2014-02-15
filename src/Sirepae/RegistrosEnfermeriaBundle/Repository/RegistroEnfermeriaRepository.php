<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Repository;
use Doctrine\ORM\EntityRepository;

class RegistroEnfermeriaRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria p ORDER BY p.name ASC'
            )
            ->getResult();
    }
    
    public function findAllEstudiante($id_estudiante)
    {
        return $this->createQueryBuilder('re')
            ->andWhere('re.estudiante = '.$id_estudiante)
            ->orderBy('re.fecha_creado','DESC')
            ->getQuery()
            ->getResult();
    }
    
    public function findAllDocente($id_docente)
    {
        return $this->createQueryBuilder('re')
            ->join('re.estudiante', 'e')
            ->join('e.practica', 'p')
            ->andWhere('p.docente = '.$id_docente)
            ->orderBy('re.fecha_creado','DESC')
            ->getQuery()
            ->getResult();
    }
    
    public function findAllCoordinador($id_docente)
    {
        return $this->createQueryBuilder('re')
            ->join('re.estudiante', 'e')
            ->join('e.practica', 'p')
            ->andWhere('p.coordinador = '.$id_docente)
            ->orderBy('re.fecha_creado','DESC')
            ->getQuery()
            ->getResult();
    }
    
    public function getRegistrosEnfermeriaBetween($campo, $from, $to){
        $qb = $this->createQueryBuilder('re');
        return $this->createQueryBuilder('re')
                ->andWhere($qb->expr()->between('re.'.$campo, $from , $to))
                ->getQuery()
                ->getResult();
    }
    
    public function getRegistrosEnfermeriaUsadosBetween($campo, $from, $to){
        $qb = $this->createQueryBuilder('re');
        return $this->createQueryBuilder('re')
                ->join('re.respuestas', 'r')
                ->andWhere($qb->expr()->between('re.'.$campo, $from , $to))
                ->getQuery()
                ->getResult();
    }
}