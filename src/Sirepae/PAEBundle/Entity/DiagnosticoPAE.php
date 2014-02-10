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
}