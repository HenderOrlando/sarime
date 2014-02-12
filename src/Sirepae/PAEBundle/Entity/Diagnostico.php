<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\DiagnosticoRepository")
 */
class Diagnostico
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
     * @ORM\Column(type="text", nullable=false)
     */
    private $definicion;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\DiagnosticoPAE", mappedBy="diagnostico")
     */
    private $planesCuidado;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\FactorRelacionado", mappedBy="diagnostico")
     */
    private $factoresRelacionados;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\Evidencia", mappedBy="diagnostico")
     */
    private $evidencias;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\Clase", inversedBy="diagnosticos")
     * @ORM\JoinColumn(name="clase_id", referencedColumnName="id", nullable=false)
     */
    private $clase;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->planesCuidado = new \Doctrine\Common\Collections\ArrayCollection();
        $this->factoresRelacionados = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evidencias = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set definicion
     *
     * @param string $definicion
     * @return Diagnostico
     */
    public function setDefinicion($definicion)
    {
        $this->definicion = $definicion;
    
        return $this;
    }

    /**
     * Get definicion
     *
     * @return string 
     */
    public function getDefinicion()
    {
        return $this->definicion;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Diagnostico
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
     * Add planesCuidado
     *
     * @param \Sirepae\PAEBundle\Entity\DiagnosticoPAE $planesCuidado
     * @return Diagnostico
     */
    public function addPlanesCuidado(\Sirepae\PAEBundle\Entity\DiagnosticoPAE $planesCuidado)
    {
        $this->planesCuidado[] = $planesCuidado;
    
        return $this;
    }

    /**
     * Remove planesCuidado
     *
     * @param \Sirepae\PAEBundle\Entity\DiagnosticoPAE $planesCuidado
     */
    public function removePlanesCuidado(\Sirepae\PAEBundle\Entity\DiagnosticoPAE $planesCuidado)
    {
        $this->planesCuidado->removeElement($planesCuidado);
    }

    /**
     * Get planesCuidado
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlanesCuidado()
    {
        return $this->planesCuidado;
    }

    /**
     * Add factoresRelacionados
     *
     * @param \Sirepae\PAEBundle\Entity\FactorRelacionado $factoresRelacionados
     * @return Diagnostico
     */
    public function addFactoresRelacionado(\Sirepae\PAEBundle\Entity\FactorRelacionado $factoresRelacionados)
    {
        $this->factoresRelacionados[] = $factoresRelacionados;
    
        return $this;
    }

    /**
     * Remove factoresRelacionados
     *
     * @param \Sirepae\PAEBundle\Entity\FactorRelacionado $factoresRelacionados
     */
    public function removeFactoresRelacionado(\Sirepae\PAEBundle\Entity\FactorRelacionado $factoresRelacionados)
    {
        $this->factoresRelacionados->removeElement($factoresRelacionados);
    }

    /**
     * Get factoresRelacionados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFactoresRelacionados()
    {
        return $this->factoresRelacionados;
    }

    /**
     * Add evidencias
     *
     * @param \Sirepae\PAEBundle\Entity\Evidencia $evidencias
     * @return Diagnostico
     */
    public function addEvidencia(\Sirepae\PAEBundle\Entity\Evidencia $evidencias)
    {
        $this->evidencias[] = $evidencias;
    
        return $this;
    }

    /**
     * Remove evidencias
     *
     * @param \Sirepae\PAEBundle\Entity\Evidencia $evidencias
     */
    public function removeEvidencia(\Sirepae\PAEBundle\Entity\Evidencia $evidencias)
    {
        $this->evidencias->removeElement($evidencias);
    }

    /**
     * Get evidencias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvidencias()
    {
        return $this->evidencias;
    }

    /**
     * Set clase
     *
     * @param \Sirepae\PAEBundle\Entity\Clase $clase
     * @return Diagnostico
     */
    public function setClase(\Sirepae\PAEBundle\Entity\Clase $clase)
    {
        $this->clase = $clase;
    
        return $this;
    }

    /**
     * Get clase
     *
     * @return \Sirepae\PAEBundle\Entity\Clase 
     */
    public function getClase()
    {
        return $this->clase;
    }
    
    public function __toString() {
        return $this->getDefinicion();
    }
}