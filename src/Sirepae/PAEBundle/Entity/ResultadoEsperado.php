<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\ResultadoEsperadoRepository")
 */
class ResultadoEsperado
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
    private $definicion;

    /** 
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $dominio;

    /** 
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $clase;

    /** 
     * @ORM\Column(type="string", length=6, nullable=false)
     */
    private $codigo;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\Indicador", mappedBy="resultadoEsperado")
     */
    private $indicadores;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PAEBundle\Entity\NOC", inversedBy="resultadosEsperados")
     * @ORM\JoinColumn(name="noc_id", referencedColumnName="id", nullable=false)
     */
    private $NOC;

    /** 
     * @ORM\ManyToMany(targetEntity="\Sirepae\PAEBundle\Entity\Escala", mappedBy="resultadosEsperados", cascade={"all"})
     */
    private $escalas;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->indicadores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->escalas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ResultadoEsperado
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
     * Set dominio
     *
     * @param string $dominio
     * @return ResultadoEsperado
     */
    public function setDominio($dominio)
    {
        $this->dominio = $dominio;
    
        return $this;
    }

    /**
     * Get dominio
     *
     * @return string 
     */
    public function getDominio()
    {
        return $this->dominio;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return ResultadoEsperado
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
     * Set clase
     *
     * @param string $clase
     * @return ResultadoEsperado
     */
    public function setClase($clase)
    {
        $this->clase = $clase;
    
        return $this;
    }

    /**
     * Get clase
     *
     * @return string 
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return ResultadoEsperado
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
     * @return ResultadoEsperado
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
     * Add indicadores
     *
     * @param \Sirepae\PAEBundle\Entity\Indicador $indicadores
     * @return ResultadoEsperado
     */
    public function addIndicadore(\Sirepae\PAEBundle\Entity\Indicador $indicadores)
    {
        $this->indicadores[] = $indicadores;
    
        return $this;
    }

    /**
     * Remove indicadores
     *
     * @param \Sirepae\PAEBundle\Entity\Indicador $indicadores
     */
    public function removeIndicadore(\Sirepae\PAEBundle\Entity\Indicador $indicadores)
    {
        $this->indicadores->removeElement($indicadores);
    }

    /**
     * Get indicadores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIndicadores()
    {
        return $this->indicadores;
    }

    /**
     * Set NOC
     *
     * @param \Sirepae\PAEBundle\Entity\NOC $nOC
     * @return ResultadoEsperado
     */
    public function setNOC(\Sirepae\PAEBundle\Entity\NOC $nOC)
    {
        $this->NOC = $nOC;
    
        return $this;
    }

    /**
     * Get NOC
     *
     * @return \Sirepae\PAEBundle\Entity\NOC 
     */
    public function getNOC()
    {
        return $this->NOC;
    }

    /**
     * Add escalas
     *
     * @param \Sirepae\PAEBundle\Entity\Escala $escalas
     * @return ResultadoEsperado
     */
    public function addEscala(\Sirepae\PAEBundle\Entity\Escala $escalas)
    {
        $this->escalas[] = $escalas;
    
        return $this;
    }

    /**
     * Remove escalas
     *
     * @param \Sirepae\PAEBundle\Entity\Escala $escalas
     */
    public function removeEscala(\Sirepae\PAEBundle\Entity\Escala $escalas)
    {
        $this->escalas->removeElement($escalas);
    }

    /**
     * Get escalas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEscalas()
    {
        return $this->escalas;
    }
    
    public function __toString() {
        return $this->getDefinicion().' - '.$this->getCodigo();
    }
}