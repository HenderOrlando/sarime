<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\IndicadorRepository")
 */
class Indicador
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="text", nullable=false)
     */
    private $definicion;

    /** 
     * @ORM\Column(type="string", length=8, nullable=false)
     */
    private $codigo;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\IndicadorPAE", mappedBy="indicador")
     */
    private $planesCuidado;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\ResultadoEsperado", inversedBy="indicadores")
     * @ORM\JoinColumn(name="resultado_esperado_id", referencedColumnName="id", nullable=false)
     */
    private $resultadoEsperado;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->planesCuidado = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set definicion
     *
     * @param string $definicion
     * @return Indicador
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
     * Set codigo
     *
     * @param string $codigo
     * @return Indicador
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
     * @return Indicador
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
     * @param \Sirepae\PAEBundle\Entity\IndicadorPAE $planesCuidado
     * @return Indicador
     */
    public function addPlanesCuidado(\Sirepae\PAEBundle\Entity\IndicadorPAE $planesCuidado)
    {
        $this->planesCuidado[] = $planesCuidado;
    
        return $this;
    }

    /**
     * Remove planesCuidado
     *
     * @param \Sirepae\PAEBundle\Entity\IndicadorPAE $planesCuidado
     */
    public function removePlanesCuidado(\Sirepae\PAEBundle\Entity\IndicadorPAE $planesCuidado)
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
     * Set resultadoEsperado
     *
     * @param \Sirepae\PAEBundle\Entity\ResultadoEsperado $resultadoEsperado
     * @return Indicador
     */
    public function setResultadoEsperado(\Sirepae\PAEBundle\Entity\ResultadoEsperado $resultadoEsperado)
    {
        $this->resultadoEsperado = $resultadoEsperado;
    
        return $this;
    }

    /**
     * Get resultadoEsperado
     *
     * @return \Sirepae\PAEBundle\Entity\ResultadoEsperado 
     */
    public function getResultadoEsperado()
    {
        return $this->resultadoEsperado;
    }
}