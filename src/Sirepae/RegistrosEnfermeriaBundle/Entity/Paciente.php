<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\RegistrosEnfermeriaBundle\Repository\PacienteRepository")
 */
class Paciente
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
    private $nombres;

    /** 
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $apellidos;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $direccion;

    /** 
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $telefonos;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\Column(type="integer", length=12, nullable=false)
     */
    private $cedula;

    /** 
     * @ORM\OneToOne(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaPaciente", 
     *     mappedBy="paciente"
     * )
     * @ORM\OrderBy({"fecha_creado" = "DESC"})
     */
    private $respuestas;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\PAE", mappedBy="paciente")
     */
    private $planesCuidado;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria", mappedBy="paciente")
     */
    private $registrosEnfermeria;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->planesCuidado = new \Doctrine\Common\Collections\ArrayCollection();
        $this->registrosEnfermeria = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombres
     *
     * @param string $nombres
     * @return Paciente
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    
        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Paciente
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    
        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Paciente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefonos
     *
     * @param string $telefonos
     * @return Paciente
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;
    
        return $this;
    }

    /**
     * Get telefonos
     *
     * @return string 
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Paciente
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
     * Set cedula
     *
     * @param integer $cedula
     * @return Paciente
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    
        return $this;
    }

    /**
     * Get cedula
     *
     * @return integer 
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set respuestas
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaPaciente $respuestas
     * @return Paciente
     */
    public function setRespuestas(\Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaPaciente $respuestas = null)
    {
        $this->respuestas = $respuestas;
    
        return $this;
    }

    /**
     * Get respuestas
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaPaciente 
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }

    /**
     * Add planesCuidado
     *
     * @param \Sirepae\PAEBundle\Entity\PAE $planesCuidado
     * @return Paciente
     */
    public function addPlanesCuidado(\Sirepae\PAEBundle\Entity\PAE $planesCuidado)
    {
        $this->planesCuidado[] = $planesCuidado;
    
        return $this;
    }

    /**
     * Remove planesCuidado
     *
     * @param \Sirepae\PAEBundle\Entity\PAE $planesCuidado
     */
    public function removePlanesCuidado(\Sirepae\PAEBundle\Entity\PAE $planesCuidado)
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
     * Add registrosEnfermeria
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria $registrosEnfermeria
     * @return Paciente
     */
    public function addRegistrosEnfermeria(\Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria $registrosEnfermeria)
    {
        $this->registrosEnfermeria[] = $registrosEnfermeria;
    
        return $this;
    }

    /**
     * Remove registrosEnfermeria
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria $registrosEnfermeria
     */
    public function removeRegistrosEnfermeria(\Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria $registrosEnfermeria)
    {
        $this->registrosEnfermeria->removeElement($registrosEnfermeria);
    }

    /**
     * Get registrosEnfermeria
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRegistrosEnfermeria()
    {
        return $this->registrosEnfermeria;
    }
    
    public function getFullName(){
        return $this->getNombres().' '.$this->getApellidos().'('.$this->getCedula().')';
    }
    
    public function __toString() {
        return $this->getFullName();
    }
}