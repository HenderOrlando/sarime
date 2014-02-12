<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\IntervencionRepository")
 */
class Intervencion
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $codigo;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\Actividad", mappedBy="intervencion")
     */
    private $actividades;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\NIC", inversedBy="intervenciones")
     * @ORM\JoinColumn(name="nic_id", referencedColumnName="id", nullable=false)
     */
    private $nic;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Intervencion
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
     * @return Intervencion
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
     * Set codigo
     *
     * @param string $codigo
     * @return Intervencion
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Intervencion
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
     * Add actividades
     *
     * @param \Sirepae\PAEBundle\Entity\Actividad $actividades
     * @return Intervencion
     */
    public function addActividade(\Sirepae\PAEBundle\Entity\Actividad $actividades)
    {
        $this->actividades[] = $actividades;
    
        return $this;
    }

    /**
     * Remove actividades
     *
     * @param \Sirepae\PAEBundle\Entity\Actividad $actividades
     */
    public function removeActividade(\Sirepae\PAEBundle\Entity\Actividad $actividades)
    {
        $this->actividades->removeElement($actividades);
    }

    /**
     * Get actividades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActividades()
    {
        return $this->actividades;
    }

    /**
     * Set nic
     *
     * @param \Sirepae\PAEBundle\Entity\NIC $nic
     * @return Intervencion
     */
    public function setNIC(NIC $nic)
    {
        $this->nic = $nic;
    
        return $this;
    }

    /**
     * Get nic
     *
     * @return \Sirepae\PAEBundle\Entity\NIC 
     */
    public function getNIC()
    {
        return $this->nic;
    }
    
    public function __toString() {
        return $this->getNombre().' Cod. '.$this->getCodigo();
    }
}