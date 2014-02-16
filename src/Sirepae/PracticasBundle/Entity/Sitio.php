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
     * @ORM\ManyToOne(targetEntity="\Sirepae\PracticasBundle\Entity\Sede", inversedBy="sitios", cascade={"all"})
     * @ORM\JoinColumn(name="sede_id", referencedColumnName="id", nullable=false)
     */
    private $sede;

    /** 
     * @ORM\ManyToMany(targetEntity="\Sirepae\PracticasBundle\Entity\Area", mappedBy="sitios", cascade={"all"})
     */
    private $areas;
    
    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PracticasBundle\Entity\Practica", mappedBy="sitio", cascade={"all"})
     */
    private $practicas;
    
    
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
     * Exist area
     *
     * @param \Sirepae\PracticasBundle\Entity\Area $area
     * @return boolean
     */
    public function existArea(\Sirepae\PracticasBundle\Entity\Area $area_)
    {
        return $this->areas->exists(function($key, Area $area) use ($area_){
            return $area->getId() == $area_->getId();
        });
    }

    /**
     * Exist materia
     *
     * @param \Sirepae\PracticasBundle\Entity\Materia $materia
     * @return boolean
     */
    public function existMateria(\Sirepae\PracticasBundle\Entity\Materia $materia_)
    {
        return $this->areas->exists(function($key, Area $area) use ($materia_){
            return $area->existMateria($materia_);
        });
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
    
    /**
     * Add practicas
     *
     * @param \Sirepae\PracticasBundle\Entity\Practica $practicas
     * @return Sede
     */
    public function addPractica(\Sirepae\PracticasBundle\Entity\Practica $practicas)
    {
        $this->practicas[] = $practicas;
    
        return $this;
    }

    /**
     * Remove practicas
     *
     * @param \Sirepae\PracticasBundle\Entity\Practica $practicas
     */
    public function removePractica(\Sirepae\PracticasBundle\Entity\Practica $practicas)
    {
        $this->practicas->removeElement($practicas);
    }

    /**
     * Get practicas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPracticas()
    {
        return $this->practicas;
    }
    
    public function __toString() {
        return $this->getNombre().'('.$this->getNombreDirector().')';
    }
}