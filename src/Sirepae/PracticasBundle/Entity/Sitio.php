<?php
namespace Sirepae\PracticasBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="Sirepae\PracticasBundle\Repository\SitioRepository")
 */
class Sitio
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
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $nombre_director;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PracticasBundle\Entity\Sede", inversedBy="sitios")
     * @ORM\JoinColumn(name="sede_id", referencedColumnName="id", nullable=false)
     */
    private $sede;

    /** 
     * @ORM\ManyToMany(targetEntity="\Sirepae\PracticasBundle\Entity\Area", mappedBy="sitios")
     */
    private $areas;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->areas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Sitio
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
     * @return Sitio
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
     * @return Sitio
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
     * Set nombre_director
     *
     * @param string $nombreDirector
     * @return Sitio
     */
    public function setNombreDirector($nombreDirector)
    {
        $this->nombre_director = $nombreDirector;
    
        return $this;
    }

    /**
     * Get nombre_director
     *
     * @return string 
     */
    public function getNombreDirector()
    {
        return $this->nombre_director;
    }

    /**
     * Set sede
     *
     * @param \Sirepae\PracticasBundle\Entity\Sede $sede
     * @return Sitio
     */
    public function setSede(\Sirepae\PracticasBundle\Entity\Sede $sede)
    {
        $this->sede = $sede;
    
        return $this;
    }

    /**
     * Get sede
     *
     * @return \Sirepae\PracticasBundle\Entity\Sede 
     */
    public function getSede()
    {
        return $this->sede;
    }

    /**
     * Add areas
     *
     * @param \Sirepae\PracticasBundle\Entity\Area $areas
     * @return Sitio
     */
    public function addArea(\Sirepae\PracticasBundle\Entity\Area $areas)
    {
        $this->areas[] = $areas;
    
        return $this;
    }

    /**
     * Remove areas
     *
     * @param \Sirepae\PracticasBundle\Entity\Area $areas
     */
    public function removeArea(\Sirepae\PracticasBundle\Entity\Area $areas)
    {
        $this->areas->removeElement($areas);
    }

    /**
     * Get areas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAreas()
    {
        return $this->areas;
    }
    
    public function __toString() {
        return $this->getNombre().'('.$this->getNombreDirector().')';
    }
}