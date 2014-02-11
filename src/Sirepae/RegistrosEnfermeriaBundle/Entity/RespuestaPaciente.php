<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\RegistrosEnfermeriaBundle\Repository\RespuestaPacienteRepository")
 */
class RespuestaPaciente
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /** 
     * @ORM\Column(type="bigint", nullable=false)
     */
    private $numero;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToOne(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Paciente", 
     *     inversedBy="respuestas", 
     *     cascade={"all"}
     * )
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id", nullable=false, unique=true)
     */
    private $paciente;

    /** 
     * @ORM\OneToOne(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta", 
     *     inversedBy="pacientes", 
     *     cascade={"all"}
     * )
     * @ORM\JoinColumn(name="respuesta_id", referencedColumnName="id", nullable=false, unique=true)
     */
    private $respuesta;
    
    
    /******************* MÉTODOS *******************/
    
    
    public function __construct() {
        $this->numero = 1;
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
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return RespuestaPaciente
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
     * Set numero
     *
     * @param bigint $numero
     * @return RespuestaPaciente
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return bigint
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set paciente
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Paciente $paciente
     * @return RespuestaPaciente
     */
    public function setPaciente(\Sirepae\RegistrosEnfermeriaBundle\Entity\Paciente $paciente)
    {
        $this->paciente = $paciente;
    
        return $this;
    }

    /**
     * Get paciente
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\Paciente 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set respuesta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta $respuesta
     * @return RespuestaPaciente
     */
    public function setRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta $respuesta)
    {
        $this->respuesta = $respuesta;
    
        return $this;
    }

    /**
     * Get respuesta
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }
}