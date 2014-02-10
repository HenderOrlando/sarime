<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\ActividadRepository")
 */
class Actividad
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $nombre;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\ActividadPAE", mappedBy="actividad")
     */
    private $PlanesCuidado;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\Intervencion", inversedBy="actividades")
     * @ORM\JoinColumn(name="intervencion_id", referencedColumnName="id", nullable=false)
     */
    private $intervencion;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->PlanesCuidado = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Actividad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Actividad
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Actividad
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
     * Add PlanesCuidado
     *
     * @param \Sirepae\PAEBundle\Entity\ActividadPAE $planesCuidado
     * @return Actividad
     */
    public function addPlanesCuidado(\Sirepae\PAEBundle\Entity\ActividadPAE $planesCuidado)
    {
        $this->PlanesCuidado[] = $planesCuidado;
    
        return $this;
    }

    /**
     * Remove PlanesCuidado
     *
     * @param \Sirepae\PAEBundle\Entity\ActividadPAE $planesCuidado
     */
    public function removePlanesCuidado(\Sirepae\PAEBundle\Entity\ActividadPAE $planesCuidado)
    {
        $this->PlanesCuidado->removeElement($planesCuidado);
    }

    /**
     * Get PlanesCuidado
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlanesCuidado()
    {
        return $this->PlanesCuidado;
    }

    /**
     * Set intervencion
     *
     * @param \Sirepae\PAEBundle\Entity\Intervencion $intervencion
     * @return Actividad
     */
    public function setIntervencion(\Sirepae\PAEBundle\Entity\Intervencion $intervencion)
    {
        $this->intervencion = $intervencion;
    
        return $this;
    }

    /**
     * Get intervencion
     *
     * @return \Sirepae\PAEBundle\Entity\Intervencion 
     */
    public function getIntervencion()
    {
        return $this->intervencion;
    }
}