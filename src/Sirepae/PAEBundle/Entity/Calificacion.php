<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\CalificacionRepository")
 */
class Calificacion
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="float", nullable=false)
     */
    private $valor;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $observacion;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToOne(targetEntity="\Sirepae\PAEBundle\Entity\PAE", inversedBy="calificacion", cascade={"all"})
     * @ORM\JoinColumn(name="pae_id", referencedColumnName="id", nullable=false, unique=true)
     */
    private $PAE;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\UsuariosBundle\Entity\Usuario", inversedBy="calificaciones", cascade={"all"})
     * @ORM\JoinColumn(name="docente_id", referencedColumnName="id", nullable=false)
     */
    private $docente;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set valor
     *
     * @param float $valor
     * @return Calificacion
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
     * Set observacion
     *
     * @param string $observacion
     * @return Calificacion
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    
        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Calificacion
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
     * Set PAE
     *
     * @param \Sirepae\PAEBundle\Entity\PAE $pAE
     * @return Calificacion
     */
    public function setPAE(\Sirepae\PAEBundle\Entity\PAE $pAE)
    {
        $this->PAE = $pAE;
    
        return $this;
    }

    /**
     * Get PAE
     *
     * @return \Sirepae\PAEBundle\Entity\PAE 
     */
    public function getPAE()
    {
        return $this->PAE;
    }

    /**
     * Set docente
     *
     * @param \Sirepae\UsuariosBundle\Entity\Usuario $docente
     * @return Calificacion
     */
    public function setDocente(\Sirepae\UsuariosBundle\Entity\Usuario $docente)
    {
        $this->docente = $docente;
    
        return $this;
    }

    /**
     * Get docente
     *
     * @return \Sirepae\UsuariosBundle\Entity\Usuario 
     */
    public function getDocente()
    {
        return $this->docente;
    }
}