<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\ActividadPAERepository")
 */
class ActividadPAE
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
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\PAE", inversedBy="actividades")
     * @ORM\JoinColumn(name="plan_cuidado_id", referencedColumnName="id", nullable=false)
     */
    private $planCuidado;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\Actividad", inversedBy="PlanesCuidado")
     * @ORM\JoinColumn(name="actividad_id", referencedColumnName="id", nullable=false)
     */
    private $actividad;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @return ActividadPAE
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
     * @return ActividadPAE
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
     * Set actividad
     *
     * @param \Sirepae\PAEBundle\Entity\Actividad $actividad
     * @return ActividadPAE
     */
    public function setActividad(\Sirepae\PAEBundle\Entity\Actividad $actividad)
    {
        $this->actividad = $actividad;
    
        return $this;
    }

    /**
     * Get actividad
     *
     * @return \Sirepae\PAEBundle\Entity\Actividad 
     */
    public function getActividad()
    {
        return $this->actividad;
    }
}