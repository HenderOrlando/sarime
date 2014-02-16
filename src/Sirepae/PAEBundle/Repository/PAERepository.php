<?php
namespace Sirepae\PAEBundle\Repository;
use Doctrine\ORM\EntityRepository;

class PAERepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaePAEBundle:PAE p ORDER BY p.name ASC'
            )
            ->getResult();
    }
    
    public function findAllEstudiante($id_estudiante, $qb = false)
    {
        $q = $this->createQueryBuilder('pae')
            ->andWhere('pae.estudiante = '.$id_estudiante)
            ->orderBy('pae.fecha_creado','DESC')
            ;
        if($qb){
            return $q;
        }
        return $q->getQuery()->getResult();
    }
    
    public function findAllDocente($id_docente, $qb = false)
    {
        $q = $this->createQueryBuilder('pae')
            ->join('pae.estudiante', 'e')
            ->join('e.practica', 'p')
            ->andWhere('p.docente = '.$id_docente)
            ->orderBy('pae.fecha_creado','DESC')
            ;
        if($qb){
            return $q;
        }
        return $q->getQuery()->getResult();
    }
    
    public function findAllCoordinador($id_coordinador, $qb = false)
    {
        $q = $this->createQueryBuilder('pae')
            ->join('pae.estudiante', 'e')
            ->join('e.practica', 'p')
            ->andWhere('p.coordinador = '.$id_coordinador)
            ->orderBy('pae.fecha_creado','DESC');
        if($qb){
            return $q;
        }
        return $q->getQuery()->getResult();
    }
    
    public function getPaesBetween($campo, $from, $to){
        $qb = $this->createQueryBuilder('pae');
        return $this->createQueryBuilder('pae')
                ->andWhere($qb->expr()->between('pae.'.$campo, $from , $to))
                ->getQuery()
                ->getResult();
    }
    
    public function getPaesCalificadosBetween($campo, $from, $to){
        $qb = $this->createQueryBuilder('pae');
        return $this->createQueryBuilder('pae')
                ->join('pae.calificacion', 'c')
                ->andWhere('c.valor NOT NULL')
                ->andWhere($qb->expr()->between('pae.'.$campo, $from , $to))
                ->getQuery()
                ->getResult();
    }

    public function getActividadesPAE() {
        return $this->createQueryBuilder('pae')
                ->join('pae.actividades', 'a')
                ->getQuery()
                ->getResult();
    }

    public function getIndicadoresPAE() {
        return $this->createQueryBuilder('pae')
                ->join('pae.indicadores', 'a')
                ->getQuery()
                ->getResult();
        
    }

    public function getDiagnosticosPAE() {
        return $this->createQueryBuilder('pae')
                ->join('pae.diagnosticos', 'a')
                ->getQuery()
                ->getResult();
        
    }

    public function findAllPaesGroupByDiagnostico($id, $roles='ROLE_COORDINADOR'){
        $q = $this->getEntityManager()
                ->getRepository('SirepaePAEBundle:Diagnostico')
                ->createQueryBuilder('d')
                ->join('d.planesCuidado', 'paed')
                ->join('paed.planCuidado', 'pae');
        if(strpos($roles, 'COORDINADOR')){
            $q  ->join('pae.estudiante', 'e')
                ->join('e.practica', 'p')
                ->andWhere('p.coordinador = '.$id)
                ->orderBy('pae.fecha_creado','DESC');
        }elseif(strpos($roles, 'DOCENTE')){
            $q  ->join('pae.estudiante', 'e')
                ->join('e.practica', 'p')
                ->andWhere('p.docente = '.$id)
                ->orderBy('pae.fecha_creado','DESC');
        }
        return $q
//            ->join('pae.diagnosticos', 'd')
            ->groupBy('d.id')
            //->addSelect('COUNT(d.id) as num_diagnostico')
            ->getQuery()
            ->getResult();
    }
}