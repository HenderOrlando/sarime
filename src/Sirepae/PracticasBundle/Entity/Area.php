<?php
namespace Sirepae\PracticasBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="Sirepae\PracticasBundle\Repository\AreaRepository")
 */
class Area
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
     * @ORM\OneToMany(targetEntity="\Sirepae\PracticasBundle\Entity\Practica", mappedBy="areaPractica")
     */
    private $practicas;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PracticasBundle\Entity\Materia", mappedBy="area")
     */
    private $materias;

    /** 
     * @ORM\ManyToMany(targetEntity="\Sirepae\PracticasBundle\Entity\Sitio", inversedBy="areas")
     * @ORM\JoinTable(
     *     name="SitioArea", 
     *     joinColumns={@ORM\JoinColumn(name="area_id", referencedColumnName="id", nullable=false)}, 
     *     inverseJoinColumns={@ORM\JoinColumn(name="sitio_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $sitios;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->practicas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->materias = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Area
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
     * @return Area
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
     * @return Area
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
     * Add practicas
     *
     * @param \Sirepae\PracticasBundle\Entity\Practica $practicas
     * @return Area
     */
    public function addPracticas(\Sirepae\PracticasBundle\Entity\Practica $practicas)
    {
        $this->practicas[] = $practicas;
    
        return $this;
    }

    /**
     * Remove practicas
     *
     * @param \Sirepae\PracticasBundle\Entity\Practica $practicas
     */
    public function removePracticas(\Sirepae\PracticasBundle\Entity\Practica $practicas)
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

    /**
     * Add materias
     *
     * @param \Sirepae\PracticasBundle\Entity\Materia $materias
     * @return Area
     */
    public function addMateria(\Sirepae\PracticasBundle\Entity\Materia $materias)
    {
        $this->materias[] = $materias;
    
        return $this;
    }

    /**
     * Remove materias
     *
     * @param \Sirepae\PracticasBundle\Entity\Materia $materias
     */
    public function removeMateria(\Sirepae\PracticasBundle\Entity\Materia $materias)
    {
        $this->materias->removeElement($materias);
    }

    /**
     * Get materias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMaterias()
    {
        return $this->materias;
    }

    /**
     * Add sitios
     *
     * @param \Sirepae\PracticasBundle\Entity\Sitio $sitios
     * @return Area
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

    /**
     * Add practicas
     *
     * @param \Sirepae\PracticasBundle\Entity\Practica $practicas
     * @return Area
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
    
    public function __toString() {
        return $this->getNombre();
    }
}