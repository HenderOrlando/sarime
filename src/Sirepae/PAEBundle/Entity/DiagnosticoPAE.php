<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\DiagnosticoPAERepository")
 */
class DiagnosticoPAE
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
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\PAE", inversedBy="diagnosticos")
     * @ORM\JoinColumn(name="plan_cuidado_id", referencedColumnName="id", nullable=false)
     */
    private $planCuidado;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\Diagnostico", inversedBy="planesCuidado")
     * @ORM\JoinColumn(name="diagnostico_id", referencedColumnName="id", nullable=false)
     */
    private $diagnostico;
    
    /** 
     * @ORM\ManyToMany(targetEntity="\Sirepae\PAEBundle\Entity\Evidencia", inversedBy="diagnosticos", cascade={"all"})
     * @ORM\JoinTable(
     *     name="EvidenciaDiagnosticoPAE", 
     *     joinColumns={@ORM\JoinColumn(name="diagnostico_id", referencedColumnName="id", nullable=false)}, 
     *     inverseJoinColumns={@ORM\JoinColumn(name="evidencia_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $evidenciasUsadas;
    
    /** 
     * @ORM\ManyToMany(targetEntity="\Sirepae\PAEBundle\Entity\FactorRelacionado", inversedBy="diagnosticos", cascade={"all"})
     * @ORM\JoinTable(
     *     name="FactorRelacionadoDiagnosticoPAE", 
     *     joinColumns={@ORM\JoinColumn(name="diagnostico_id", referencedColumnName="id", nullable=false)}, 
     *     inverseJoinColumns={@ORM\JoinColumn(name="factor_relacionado_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $factoresRelacionadosUsados;
    
    
    /******************* MÉTODOS *******************/
    
    
    public function __construct() {
        $this->setFechaCreado(new \DateTime('now'));
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return DiagnosticoPAE
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
     * @return DiagnosticoPAE
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
     * Set diagnostico
     *
     * @param \Sirepae\PAEBundle\Entity\Diagnostico $diagnostico
     * @return DiagnosticoPAE
     */
    public function setDiagnostico(\Sirepae\PAEBundle\Entity\Diagnostico $diagnostico)
    {
        $this->diagnostico = $diagnostico;
    
        return $this;
    }

    /**
     * Get diagnostico
     *
     * @return \Sirepae\PAEBundle\Entity\Diagnostico 
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }
    
    /**
     * Add evidenciasUsadas
     *
     * @param \Sirepae\PAEBundle\Entity\Evidencia $evidenciasUsadas
     * @return ResultadoEsperado
     */
    public function addEvidencia(\Sirepae\PAEBundle\Entity\Evidencia $evidenciasUsadas)
    {
        $this->evidenciasUsadas[] = $evidenciasUsadas;
    
        return $this;
    }
    
    /**
     * Exist evidencia
     *
     * @param \Sirepae\PAEBundle\Entity\Evidencia $evidencia
     * @return boolean
     */
    public function existEvidencia(\Sirepae\PAEBundle\Entity\Evidencia $evidenciaPAE)
    {
        return $this->evidenciasUsadas->exists(function($key, Evidencia $evidencia) use ($evidenciaPAE){
            return $evidencia->getId() == $evidenciaPAE->getId();
        });
    }

    /**
     * Remove evidenciasUsadas
     *
     * @param \Sirepae\PAEBundle\Entity\Evidencia $evidenciasUsadas
     */
    public function removeEvidencia(\Sirepae\PAEBundle\Entity\Evidencia $evidenciasUsadas)
    {
        $this->evidenciasUsadas->removeElement($evidenciasUsadas);
    }

    /**
     * Get evidenciasUsadas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvidencias()
    {
        return $this->evidenciasUsadas;
    }
    
    /**
     * Add factoresRelacionadosUsados
     *
     * @param \Sirepae\PAEBundle\Entity\FactorRelacionado $factoresRelacionadosUsados
     * @return ResultadoEsperado
     */
    public function addFactorRelacionado(\Sirepae\PAEBundle\Entity\FactorRelacionado $factoresRelacionadosUsados)
    {
        $this->factoresRelacionadosUsados[] = $factoresRelacionadosUsados;
    
        return $this;
    }
    
    /**
     * Exist factorRelacionado
     *
     * @param \Sirepae\PAEBundle\Entity\FactorRelacionado $factorRelacionado
     * @return boolean
     */
    public function existFactorRelacionado(\Sirepae\PAEBundle\Entity\FactorRelacionado $factorRelacionadoPAE)
    {
        return $this->factoresRelacionadosUsados->exists(function($key, FactorRelacionado $factorRelacionado) use ($factorRelacionadoPAE){
            return $factorRelacionado->getId() == $factorRelacionadoPAE->getId();
        });
    }

    /**
     * Remove factoresRelacionadosUsados
     *
     * @param \Sirepae\PAEBundle\Entity\FactorRelacionado $factoresRelacionadosUsados
     */
    public function removeFactorRelacionado(\Sirepae\PAEBundle\Entity\FactorRelacionado $factoresRelacionadosUsados)
    {
        $this->factoresRelacionadosUsados->removeElement($factoresRelacionadosUsados);
    }

    /**
     * Get factoresRelacionadosUsados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFactorRelacionados()
    {
        return $this->factoresRelacionadosUsados;
    }
}