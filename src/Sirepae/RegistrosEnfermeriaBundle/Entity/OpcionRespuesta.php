<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\RegistrosEnfermeriaBundle\Repository\OpcionRespuestaRepository")
 */
class OpcionRespuesta
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
    private $enunciado;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta", mappedBy="opcionRespuesta")
     */
    private $respuesta;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta", inversedBy="opcionesRespuesta")
     * @ORM\JoinColumn(name="pregunta_id", referencedColumnName="id", nullable=false)
     */
    private $pregunta;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\TipoRespuesta", inversedBy="respuestas")
     * @ORM\JoinColumn(name="tipo_respuesta_id", referencedColumnName="id", nullable=false)
     */
    private $tipoRespuesta;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->respuesta = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return OpcionRespuesta
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return OpcionRespuesta
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
     * @return OpcionRespuesta
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
     * Add respuesta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta $respuesta
     * @return OpcionRespuesta
     */
    public function addRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta $respuesta)
    {
        $this->respuesta[] = $respuesta;
    
        return $this;
    }

    /**
     * Remove respuesta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta $respuesta
     */
    public function removeRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta $respuesta)
    {
        $this->respuesta->removeElement($respuesta);
    }

    /**
     * Get respuesta
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set pregunta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta $pregunta
     * @return OpcionRespuesta
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
     * Set tipoRespuesta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\TipoRespuesta $tipoRespuesta
     * @return OpcionRespuesta
     */
    public function setTipoRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\TipoRespuesta $tipoRespuesta)
    {
        $this->tipoRespuesta = $tipoRespuesta;
    
        return $this;
    }

    /**
     * Get tipoRespuesta
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\TipoRespuesta 
     */
    public function getTipoRespuesta()
    {
        return $this->tipoRespuesta;
    }
    
    public function __toString() {
        return $this->enunciado;
    }
}