<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\IndicadorPAERepository")
 */
class IndicadorPAE
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\PAE", inversedBy="indicadores")
     * @ORM\JoinColumn(name="plan_cuidado_id", referencedColumnName="id", nullable=false)
     */
    private $planCuidado;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\Indicador", inversedBy="planesCuidado")
     * @ORM\JoinColumn(name="indicador_id", referencedColumnName="id", nullable=false)
     */
    private $indicador;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\Escala", inversedBy="indicadorPlanCuidado")
     * @ORM\JoinColumn(name="escala_id", referencedColumnName="id", nullable=false)
     */
    private $escala;
    
    
    /******************* MÉTODOS *******************/
    
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        $this->setFechaCreado(new \DateTime('now'));
        return $this->id;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return IndicadorPAE
     */
    public function setFechaCreado($fechaCreado)
    {
        $this->fecha_creado = $fechaCreado;
    
        return $this;
    }

    /**
     * Get fecha_creado
     *
     * @return \DateTime 
     */
    public function getFechaCreado()
    {
        return $this->fecha_creado;
    }

    /**
     * Set planCuidado
     *
     * @param \Sirepae\PAEBundle\Entity\PAE $planCuidado
     * @return IndicadorPAE
     */
    public function setPlanCuidado(\Sirepae\PAEBundle\Entity\PAE $planCuidado)
    {
        $this->planCuidado = $planCuidado;
    
        return $this;
    }

    /**
     * Get planCuidado
     *
     * @return \Sirepae\PAEBundle\Entity\PAE 
     */
    public function getPlanCuidado()
    {
        return $this->planCuidado;
    }

    /**
     * Set indicador
     *
     * @param \Sirepae\PAEBundle\Entity\Indicador $indicador
     * @return IndicadorPAE
     */
    public function setIndicador(\Sirepae\PAEBundle\Entity\Indicador $indicador)
    {
        $this->indicador = $indicador;
    
        return $this;
    }

    /**
     * Get indicador
     *
     * @return \Sirepae\PAEBundle\Entity\Indicador 
     */
    public function getIndicador()
    {
        return $this->indicador;
    }

    /**
     * Set escala
     *
     * @param \Sirepae\PAEBundle\Entity\Escala $escala
     * @return IndicadorPAE
     */
    public function setEscala(\Sirepae\PAEBundle\Entity\Escala $escala)
    {
        $this->escala = $escala;
    
        return $this;
    }

    /**
     * Get escala
     *
     * @return \Sirepae\PAEBundle\Entity\Escala 
     */
    public function getEscala()
    {
        return $this->escala;
    }
}