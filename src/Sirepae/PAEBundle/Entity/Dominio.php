<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\DominioRepository")
 */
class Dominio
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
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\Column(type="string", length=4, nullable=false)
     */
    private $codigo;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\Clase", mappedBy="dominio")
     */
    private $clases;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\NANDA", inversedBy="dominios")
     * @ORM\JoinColumn(name="nanda_id", referencedColumnName="id", nullable=false)
     */
    private $NANDA;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->clases = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Dominio
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
     * @return Dominio
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
     * @return Dominio
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
     * Set codigo
     *
     * @param string $codigo
     * @return Dominio
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
     * Add clases
     *
     * @param \Sirepae\PAEBundle\Entity\Clase $clases
     * @return Dominio
     */
    public function addClase(\Sirepae\PAEBundle\Entity\Clase $clases)
    {
        $this->clases[] = $clases;
    
        return $this;
    }

    /**
     * Remove clases
     *
     * @param \Sirepae\PAEBundle\Entity\Clase $clases
     */
    public function removeClase(\Sirepae\PAEBundle\Entity\Clase $clases)
    {
        $this->clases->removeElement($clases);
    }

    /**
     * Get clases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClases()
    {
        return $this->clases;
    }

    /**
     * Set NANDA
     *
     * @param \Sirepae\PAEBundle\Entity\NANDA $nANDA
     * @return Dominio
     */
    public function setNANDA(\Sirepae\PAEBundle\Entity\NANDA $nANDA)
    {
        $this->NANDA = $nANDA;
    
        return $this;
    }

    /**
     * Get NANDA
     *
     * @return \Sirepae\PAEBundle\Entity\NANDA 
     */
    public function getNANDA()
    {
        return $this->NANDA;
    }
    
    public function __toString() {
        return $this->getNombre().' ('.$this->getCodigo().')';
    }
}