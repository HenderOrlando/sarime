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
    
    public function getRespuestaByRegistroEnfermeriaPregunta($idRegistroEnfermeria, $idPregunta, $numero = null)
    {
        return $this->getRespuestasByRegistroEnfermeriaPregunta(false, $idRegistroEnfermeria, $idPregunta, $numero);
    }
    
    public function getRespuestasByRegistroEnfermeriaPregunta($qb, $idRegistroEnfermeria, $idPregunta, $numero = null){
        $q = $this->createQueryBuilder('rre')
            ->andWhere('rre.registroEnfermeria = '.$idRegistroEnfermeria)
            ->leftJoin('rre.respuesta', 'r')
            ->leftJoin('r.pregunta', 'p')
            ->andWhere('p.id = '.$idPregunta);
        if(is_numeric($numero))
            $q->andWhere('rre.numero = '.$numero);
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
    
    public function countRespuestasByRegistroEnfermeriaPregunta($idRegistroEnfermeria, $idPregunta, $numero = null){
        return $this->getRespuestasByRegistroEnfermeriaPregunta(4, $idRegistroEnfermeria, $idPregunta, $numero);
    }
}