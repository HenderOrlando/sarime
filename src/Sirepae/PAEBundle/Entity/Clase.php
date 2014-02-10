<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\ClaseRepository")
 */
class Clase
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
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\Diagnostico", mappedBy="clase")
     */
    private $diagnosticos;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\Dominio", inversedBy="clases")
     * @ORM\JoinColumn(name="dominio_id", referencedColumnName="id", nullable=false)
     */
    private $dominio;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->diagnosticos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Clase
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
     * @return Clase
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
     * @return Clase
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
     * Add diagnosticos
     *
     * @param \Sirepae\PAEBundle\Entity\Diagnostico $diagnosticos
     * @return Clase
     */
    public function addDiagnostico(\Sirepae\PAEBundle\Entity\Diagnostico $diagnosticos)
    {
        $this->diagnosticos[] = $diagnosticos;
    
        return $this;
    }

    /**
     * Remove diagnosticos
     *
     * @param \Sirepae\PAEBundle\Entity\Diagnostico $diagnosticos
     */
    public function removeDiagnostico(\Sirepae\PAEBundle\Entity\Diagnostico $diagnosticos)
    {
        $this->diagnosticos->removeElement($diagnosticos);
    }

    /**
     * Get diagnosticos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiagnosticos()
    {
        return $this->diagnosticos;
    }

    /**
     * Set dominio
     *
     * @param \Sirepae\PAEBundle\Entity\Dominio $dominio
     * @return Clase
     */
    public function setDominio(\Sirepae\PAEBundle\Entity\Dominio $dominio)
    {
        $this->dominio = $dominio;
    
        return $this;
    }

    /**
     * Get dominio
     *
     * @return \Sirepae\PAEBundle\Entity\Dominio 
     */
    public function getDominio()
    {
        return $this->dominio;
    }
}