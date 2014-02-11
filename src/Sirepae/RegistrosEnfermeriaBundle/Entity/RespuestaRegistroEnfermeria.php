<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(
 *     repositoryClass="\Sirepae\RegistrosEnfermeriaBundle\Repository\RespuestaRegistroEnfermeriaRepository"
 * )
 */
class RespuestaRegistroEnfermeria
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
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta", 
     *     inversedBy="registrosEnfermeria", 
     *     cascade={"all"}
     * )
     * @ORM\JoinColumn(name="respuesta_id", referencedColumnName="id", nullable=false, unique=true)
     */
    private $respuesta;

    /** 
     * @ORM\ManyToOne(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria", 
     *     inversedBy="respuestas"
     * )
     * @ORM\JoinColumn(name="registro_enfermeria_id", referencedColumnName="id", nullable=false)
     */
    private $registroEnfermeria;
    
    
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
     * @return RespuestaRegistroEnfermeria
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
     * Set respuesta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta $respuesta
     * @return RespuestaRegistroEnfermeria
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

    /**
     * Set registroEnfermeria
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria $registroEnfermeria
     * @return RespuestaRegistroEnfermeria
     */
    public function setRegistroEnfermeria(\Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria $registroEnfermeria)
    {
        $this->registroEnfermeria = $registroEnfermeria;
    
        return $this;
    }

    /**
     * Get registroEnfermeria
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria 
     */
    public function getRegistroEnfermeria()
    {
        return $this->registroEnfermeria;
    }
}