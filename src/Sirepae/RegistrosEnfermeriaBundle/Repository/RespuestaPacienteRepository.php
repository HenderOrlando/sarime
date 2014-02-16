<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Repository;
use Doctrine\ORM\EntityRepository;

class RespuestaPacienteRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaeRegistrosEnfermeriaBundle:RespuestaPaciente p ORDER BY p.name ASC'
            )
            ->getResult();
    }
    public function getRespuestasByPaciente($id)
    {
        return $this->createQueryBuilder('rp')
                ->andWhere('rp.paciente = '.$id)
                ->leftJoin('rp.respuesta', 'r')
                ->leftJoin('r.pregunta', 'p')
                ->groupBy('p.registro')
                ->getQuery()
                ->execute()
                ;
    }
    
    public function getRespuestaByPacientePregunta($idPaciente, $idPregunta, $numero = null, $id_col = null)
    {
        return $this->getRespuestasByPacientePregunta(false, $idPaciente, $idPregunta, $numero, $id_col);
    }
    
    public function getRespuestasByPacientePregunta($qb, $idPaciente, $idPregunta, $numero = null, $idCol = null){
        $q = $this->createQueryBuilder('rp')
            ->andWhere('rp.paciente = '.$idPaciente)
            ->leftJoin('rp.respuesta', 'r')
            ->leftJoin('r.pregunta', 'p');
        if(is_numeric($numero))
            $q->andWhere('rp.numero = '.$numero);
        if(is_null($idCol) && !is_null($idPregunta)){
            $q->andWhere('p.id = '.$idPregunta);
        }elseif(!is_null($idPregunta) && !is_null($idCol)){
            $q->andWhere("r.valor LIKE '%".$idCol.'-_#|#_-'.$idPregunta."-_#|#_-%'");
        }
        if(is_integer($qb) && $qb === 1)
            return $q;
        elseif(is_integer($qb) && $qb === 2)
            return $q->getQuery();
        elseif(is_integer($qb) && $qb === 3)
            return $q->getQuery()->execute();
        elseif(is_integer($qb) && $qb === 4)
            return $q->getQuery()->getSingleScalarResult();
        return $q->setMaxResults(1)->getQuery()->getOneOrNullResult();
    }
    
    public function countRespuestasByPacientePregunta($idPaciente, $idPregunta, $numero = null, $idCol){
        return $this->getRespuestasByPacientePregunta(4, $idPaciente, $idPregunta, $numero, $idCol);
    }
}