<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\RegistrosEnfermeriaBundle\Repository\RespuestaRepository")
 */
class Respuesta
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $valor;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToOne(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaPaciente", 
     *     mappedBy="respuesta", 
     *     cascade={"all"}
     * )
     */
    private $pacientes;

    /** 
     * @ORM\OneToOne(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria", 
     *     mappedBy="respuesta", 
     *     cascade={"all"}
     * )
     */
    private $registrosEnfermeria;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta", inversedBy="respuestas")
     * @ORM\JoinColumn(name="pregunta_id", referencedColumnName="id", nullable=false)
     */
    private $pregunta;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta", inversedBy="respuesta")
     * @ORM\JoinColumn(name="respuesta_id", referencedColumnName="id", nullable=false)
     */
    private $opcionRespuesta;
    
    private $col = null;
    private $row = null;
    private $cleanValor = '';
    private $cleanEnunciado = '';
    
    
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
     * Set valor
     *
     * @param string $valor
     * @return Respuesta
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function cleanValor()
    {
        if(is_null($this->cleanValor) || $this->cleanValor === ''){
            $dato = $this->getValor();
            if(is_null($dato)){
                $this->cleanValor = $this->getOpcionRespuesta()->getEnunciado();
            }elseif($this->getPregunta()->getRegistro()->isTabla()){
                $datos = explode('-_#|#_-',$dato);
                if(is_null($this->col)){
                    $this->col = $this->getPregunta()->getRegistro()->getPregunta($datos[0]);
                }
                if(is_null($this->row)){
                    $this->row = $this->getPregunta()->getRegistro()->getPregunta($datos[1]);
                }
                $this->cleanValor = $datos[2];
            }elseif($this->getPregunta()->isMultiRta()){
                $datos = explode('\#_*/|\*_#/',$dato);
                $str = array();
                $glue = ', ';
                foreach($this->getPregunta()->getOpcionesRespuesta() as $optRta){
                    foreach($datos as $dato){
                        if($optRta->getId() == $dato){
                            $str[] = $optRta->getEnunciado();
                        }
                    }
                }
                $this->cleanValor = implode($glue, $str);
            }else{
                $this->cleanValor = $dato;
            }
        }
        return $this->cleanValor;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function cleanEnunciado()
    {
        if(is_null($this->cleanEnunciado) || $this->cleanEnunciado === ''){
            $dato = $this->getValor();
            if($this->getPregunta()->getRegistro()->isTabla()){
                $datos = explode('-_#|#_-',$dato);
                if(is_null($this->col)){
                    $this->col = $this->getPregunta()->getRegistro()->getPregunta($datos[0]);
                }
                if(is_null($this->row)){
                    $this->row = $this->getPregunta()->getRegistro()->getPregunta($datos[1]);
                }
                $this->cleanEnunciado = $this->col->getEnunciado().' por '.$this->row->getEnunciado();
            }else{
                $this->cleanEnunciado = $this->getPregunta()->getEnunciado();
            }
        }
        return $this->cleanEnunciado;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Respuesta
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
     * Set pacientes
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaPaciente $pacientes
     * @return Respuesta
     */
    public function setPacientes(\Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaPaciente $pacientes = null)
    {
        $this->pacientes = $pacientes;
    
        return $this;
    }

    /**
     * Get pacientes
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaPaciente 
     */
    public function getPacientes()
    {
        return $this->pacientes;
    }

    /**
     * Set registrosEnfermeria
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria $registrosEnfermeria
     * @return Respuesta
     */
    public function setRegistrosEnfermeria(\Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria $registrosEnfermeria = null)
    {
        $this->registrosEnfermeria = $registrosEnfermeria;
    
        return $this;
    }

    /**
     * Get registrosEnfermeria
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria 
     */
    public function getRegistrosEnfermeria()
    {
        return $this->registrosEnfermeria;
    }

    /**
     * Set pregunta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta $pregunta
     * @return Respuesta
     */
    public function setPregunta(\Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta $pregunta)
    {
        $this->pregunta = $pregunta;
    
        return $this;
    }

    /**
     * Get pregunta
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta 
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }

    /**
     * Set opcionRespuesta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta $opcionRespuesta
     * @return Respuesta
     */
    public function setOpcionRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta $opcionRespuesta)
    {
        $this->opcionRespuesta = $opcionRespuesta;
    
        return $this;
    }

    /**
     * Get opcionRespuesta
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta 
     */
    public function getOpcionRespuesta()
    {
        return $this->opcionRespuesta;
    }
    
}