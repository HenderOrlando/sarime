<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Repository;
use Doctrine\ORM\EntityRepository;

class RespuestaRegistroEnfermeriaRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria p ORDER BY p.name ASC'
            )
            ->getResult();
    }
    
    public function getRespuestasByRegistro($id)
    {
        return $this->createQueryBuilder('rre')
                ->andWhere('rre.registroEnfermeria = '.$id)
                ->leftJoin('rre.respuesta', 'r')
                ->leftJoin('r.pregunta', 'p')
                ->groupBy('p.registro')
                ->getQuery()
                ->execute()
                ;
    }
    
    public function getRespuestaByRegistroEnfermeriaPregunta($idRegistroEnfermeria, $idPregunta, $numero = null, $id_col = null)
    {
        return $this->getRespuestasByRegistroEnfermeriaPregunta(false, $idRegistroEnfermeria, $idPregunta, $numero, $id_col);
    }
    /**
     * @param boolean $qb                   QueryBuilder
     * @param numeric $idRegistroEnfermeria Id del registro de enfermería
     * @param numeric $idPregunta           Id de la pregunta o de la fila
     * @param numeric $numero               Número
     * @param numeric $idCol                Id de la Columna
     * @param boolean $tabla                Busca sólo regitros que se muesten como tablas
     * @param string  $groupBy              Agrupar por el parámetro pasado. Debe ser de RespuestaRegistroEnfermería
     * @param numeric $idRegistro           Id del registro
     */
    public function getRespuestasByRegistroEnfermeriaPregunta($qb, $idRegistroEnfermeria, $idPregunta, $numero = null, $idCol = null, $tabla = false, $groupBy = null, $idRegistro = null){
        $q = $this->createQueryBuilder('rre')
            ->andWhere('rre.registroEnfermeria = '.$idRegistroEnfermeria)
            ->join('rre.respuesta', 'r')
            ->join('r.pregunta', 'p');
        if($tabla){
            $q->join('p.registro', 'reg')
                ->andWhere('reg.tabla = 1');
            if(!is_null($idRegistro) && is_numeric($idRegistro)){
                $q->andWhere('reg.id = '.$idRegistro);
            }
        }
        if(is_numeric($numero))
            $q->andWhere('rre.numero = '.$numero);
        if(is_null($idCol) && !is_null($idPregunta)){
            $q->andWhere('p.id = '.$idPregunta);
        }elseif(!is_null($idPregunta) && !is_null($idCol)){
            $q->andWhere("r.valor LIKE '%".$idCol.'-_#|#_-'.$idPregunta."-_#|#_-%'");
        }
        if(!is_null($groupBy) && is_string($groupBy)){
            $q->groupBy('rre.'.$groupBy);
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
    
    public function countRespuestasByRegistroEnfermeriaPregunta($idRegistroEnfermeria, $idPregunta, $numero = null, $idCol){
        return $this->getRespuestasByRegistroEnfermeriaPregunta(4, $idRegistroEnfermeria, $idPregunta, $numero, $idCol);
    }
}