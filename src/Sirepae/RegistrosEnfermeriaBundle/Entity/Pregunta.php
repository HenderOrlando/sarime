<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\RegistrosEnfermeriaBundle\Repository\PreguntaRepository")
 */
class Pregunta
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", length=200, nullable=false)
     */
    private $enunciado;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $ayuda;

    /** 
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $multi_rta;

    /** 
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $expandido;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\Column(type="integer", nullable=true)
     */
    private $orden;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta", mappedBy="pregunta")
     */
    private $opcionesRespuesta;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta", mappedBy="pregunta")
     */
    private $respuestas;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Registro", inversedBy="preguntas")
     * @ORM\JoinColumn(name="registro_id", referencedColumnName="id", nullable=false)
     */
    private $registro;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->opcionesRespuesta = new \Doctrine\Common\Collections\ArrayCollection();
        $this->respuestas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->multi_rta = false;
        $this->expandido = false;
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
     * Set enunciado
     *
     * @param string $enunciado
     * @return Pregunta
     */
    public function setEnunciado($enunciado)
    {
        $this->enunciado = $enunciado;
    
        return $this;
    }

    /**
     * Get enunciado
     *
     * @return string 
     */
    public function getEnunciado()
    {
        return $this->enunciado;
    }

    /**
     * Set ayuda
     *
     * @param string $ayuda
     * @return Pregunta
     */
    public function setAyuda($ayuda)
    {
        $this->ayuda = $ayuda;
    
        return $this;
    }

    /**
     * Get ayuda
     *
     * @return string 
     */
    public function getAyuda()
    {
        return $this->ayuda;
    }

    /**
     * Set multi_rta
     *
     * @param boolean $multiRta
     * @return Pregunta
     */
    public function setMultiRta($multiRta)
    {
        $this->multi_rta = $multiRta;
    
        return $this;
    }

    /**
     * Get multi_rta
     *
     * @return boolean 
     */
    public function getMultiRta()
    {
        return $this->multi_rta;
    }

    /**
     * Set expandido
     *
     * @param boolean $expandido
     * @return Pregunta
     */
    public function setExpandido($expandido)
    {
        $this->expandido = $expandido;
    
        return $this;
    }

    /**
     * Get expandido
     *
     * @return boolean 
     */
    public function getExpandido()
    {
        return $this->expandido;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Pregunta
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
     * Set orden
     *
     * @param \Integer $orden
     * @return Pregunta
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return \Integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Add opcionesRespuesta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta $opcionesRespuesta
     * @return Pregunta
     */
    public function addOpcionesRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta $opcionesRespuesta)
    {
        $this->opcionesRespuesta[] = $opcionesRespuesta;
    
        return $this;
    }

    /**
     * Remove opcionesRespuesta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta $opcionesRespuesta
     */
    public function removeOpcionesRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta $opcionesRespuesta)
    {
        $this->opcionesRespuesta->removeElement($opcionesRespuesta);
    }

    /**
     * Get opcionesRespuesta
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOpcionesRespuesta()
    {
        return $this->opcionesRespuesta;
    }

    /**
     * Add respuestas
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta $respuestas
     * @return Pregunta
     */
    public function addRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta $respuestas)
    {
        $this->respuestas[] = $respuestas;
    
        return $this;
    }

    /**
     * Remove respuestas
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta $respuestas
     */
    public function removeRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta $respuestas)
    {
        $this->respuestas->removeElement($respuestas);
    }

    /**
     * Get respuestas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }

    /**
     * Set registro
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Registro $registro
     * @return Pregunta
     */
    public function setRegistro(\Sirepae\RegistrosEnfermeriaBundle\Entity\Registro $registro)
    {
        $this->registro = $registro;
    
        return $this;
    }

    /**
     * Get registro
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\Registro 
     */
    public function getRegistro()
    {
        return $this->registro;
    }
    
    public function __toString() {
        return '"'.$this->getEnunciado().'" del Registro '.$this->getRegistro()->getNombre();
    }
}