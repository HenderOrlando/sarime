<?php
namespace Sirepae\PracticasBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="Sirepae\PracticasBundle\Repository\SedeRepository")
 */
class Sede
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $direccion;

    /** 
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $telefonos;

    /** 
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $correo;

    /** 
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $nombre_director;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PracticasBundle\Entity\Sitio", mappedBy="sede", cascade={"all"})
     */
    private $sitios;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->sitios = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * Set direccion
     *
     * @param string $direccion
     * @return Sede
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefonos
     *
     * @param string $telefonos
     * @return Sede
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;
    
        return $this;
    }

    /**
     * Get telefonos
     *
     * @return string 
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return Sede
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    
        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set nombre_director
     *
     * @param string $nombreDirector
     * @return Sede
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
     * Add sitios
     *
     * @param \Sirepae\PracticasBundle\Entity\Sitio $sitios
     * @return Sede
     */
    public function addSitio(\Sirepae\PracticasBundle\Entity\Sitio $sitios)
    {
        $this->sitios[] = $sitios;
    
        return $this;
    }

    /**
     * Remove sitios
     *
     * @param \Sirepae\PracticasBundle\Entity\Sitio $sitios
     */
    public function removeSitio(\Sirepae\PracticasBundle\Entity\Sitio $sitios)
    {
        $this->sitios->removeElement($sitios);
    }

    /**
     * Get sitios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSitios()
    {
        return $this->sitios;
    }
    
    public function __toString() {
        return $this->getNombre().'('.$this->getNombreDirector().')';
    }
}