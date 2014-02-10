<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\EscalaRepository")
 */
class Escala
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", unique=true, length=50, nullable=false)
     */
    private $nombre;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /** 
     * @ORM\Column(type="decimal", nullable=false)
     */
    private $valor;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\IndicadorPAE", mappedBy="escala")
     */
    private $indicadorPlanCuidado;

    /** 
     * @ORM\ManyToMany(targetEntity="\Sirepae\PAEBundle\Entity\ResultadoEsperado", inversedBy="escalas")
     * @ORM\JoinTable(
     *     name="ResultadoEsperadoEscala", 
     *     joinColumns={@ORM\JoinColumn(name="escala_id", referencedColumnName="id", nullable=false)}, 
     *     inverseJoinColumns={@ORM\JoinColumn(name="resultado_esperado_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $resultadosEsperados;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->indicadorPlanCuidado = new \Doctrine\Common\Collections\ArrayCollection();
        $this->resultadosEsperados = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Escala
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
     * @return Escala
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
     * Set valor
     *
     * @param float $valor
     * @return Escala
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return float 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Escala
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
     * Add indicadorPlanCuidado
     *
     * @param \Sirepae\PAEBundle\Entity\IndicadorPAE $indicadorPlanCuidado
     * @return Escala
     */
    public function addIndicadorPlanCuidado(\Sirepae\PAEBundle\Entity\IndicadorPAE $indicadorPlanCuidado)
    {
        $this->indicadorPlanCuidado[] = $indicadorPlanCuidado;
    
        return $this;
    }

    /**
     * Remove indicadorPlanCuidado
     *
     * @param \Sirepae\PAEBundle\Entity\IndicadorPAE $indicadorPlanCuidado
     */
    public function removeIndicadorPlanCuidado(\Sirepae\PAEBundle\Entity\IndicadorPAE $indicadorPlanCuidado)
    {
        $this->indicadorPlanCuidado->removeElement($indicadorPlanCuidado);
    }

    /**
     * Get indicadorPlanCuidado
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIndicadorPlanCuidado()
    {
        return $this->indicadorPlanCuidado;
    }

    /**
     * Add resultadosEsperados
     *
     * @param \Sirepae\PAEBundle\Entity\ResultadoEsperado $resultadosEsperados
     * @return Escala
     */
    public function addResultadosEsperado(\Sirepae\PAEBundle\Entity\ResultadoEsperado $resultadosEsperados)
    {
        $this->resultadosEsperados[] = $resultadosEsperados;
    
        return $this;
    }

    /**
     * Remove resultadosEsperados
     *
     * @param \Sirepae\PAEBundle\Entity\ResultadoEsperado $resultadosEsperados
     */
    public function removeResultadosEsperado(\Sirepae\PAEBundle\Entity\ResultadoEsperado $resultadosEsperados)
    {
        $this->resultadosEsperados->removeElement($resultadosEsperados);
    }

    /**
     * Get resultadosEsperados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResultadosEsperados()
    {
        return $this->resultadosEsperados;
    }
}