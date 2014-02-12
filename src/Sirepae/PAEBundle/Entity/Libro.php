<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\MappedSuperclass
 */
class Libro
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $isbn;

    /** 
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $version;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;
    
    
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
     * Set isbn
     *
     * @param string $isbn
     * @return Libro
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    
        return $this;
    }

    /**
     * Get isbn
     *
     * @return string 
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Libro
     */
    public function setVersion($version)
    {
        $this->version = $version;
    
        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Libro
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
    
    public function __toString() {
        return $this->getIsbn().' version '.$this->getVersion();
    }
}