<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\EvidenciaRepository")
 */
class Evidencia
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
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\Diagnostico", inversedBy="evidencias")
     * @ORM\JoinColumn(name="diagnostico_id", referencedColumnName="id", nullable=false)
     */
    private $diagnostico;
    
    /** 
     * @ORM\ManyToMany(targetEntity="\Sirepae\PAEBundle\Entity\DiagnosticoPAE", mappedBy="evidenciasUsadas", cascade={"all"})
     */
    private $diagnosticos;
    
    
    /******************* MÉTODOS *******************/
    
    
    public function __construct() {
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
     * @return Evidencia
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
     * @return Evidencia
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
     * @return Evidencia
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
     * Set diagnostico
     *
     * @param \Sirepae\PAEBundle\Entity\Diagnostico $diagnostico
     * @return Evidencia
     */
    public function setDiagnostico(\Sirepae\PAEBundle\Entity\Diagnostico $diagnostico)
    {
        $this->diagnostico = $diagnostico;
    
        return $this;
    }

    /**
     * Get diagnostico
     *
     * @return \Sirepae\PAEBundle\Entity\Diagnostico 
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }

    /**
     * Add diagnosticos
     *
     * @param \Sirepae\PAEBundle\Entity\DiagnosticoPAE $diagnosticos
     * @return Escala
     */
    public function addDiagnostico(\Sirepae\PAEBundle\Entity\DiagnosticoPAE $diagnosticos)
    {
        $this->diagnosticos[] = $diagnosticos;
    
        return $this;
    }
    
    /**
     * Exist diagnostico
     *
     * @param \Sirepae\PAEBundle\Entity\Diagnostico $diagnostico
     * @return boolean
     */
    public function existDiagnostico(\Sirepae\PAEBundle\Entity\Diagnostico $diagnostico)
    {
        return $this->diagnosticos->exists(function($key, DiagnosticoPAE $diagnosticoPAE) use ($diagnostico){
            return $diagnostico->getId() == $diagnosticoPAE->getDiagnostico()->getId();
        });
    }

    /**
     * Remove diagnosticos
     *
     * @param \Sirepae\PAEBundle\Entity\DiagnosticoPAE $diagnosticos
     */
    public function removeDiagnostico(\Sirepae\PAEBundle\Entity\DiagnosticoPAE $diagnosticos)
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
}