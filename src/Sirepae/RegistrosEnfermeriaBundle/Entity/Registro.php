<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\RegistrosEnfermeriaBundle\Repository\RegistroRepository")
 */
class Registro
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $nombre;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta", mappedBy="registro")
     */
    private $preguntas;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Tipo", inversedBy="registros")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id", nullable=false)
     */
    private $tipo;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->preguntas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Registro
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
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Registro
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
     * Add pregunta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta $pregunta
     * @return Registro
     */
    public function addPregunta(\Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta $pregunta)
    {
        $this->preguntas[] = $pregunta;
    
        return $this;
    }

    /**
     * Remove pregunta
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta $pregunta
     */
    public function removePregunta(\Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta $pregunta)
    {
        $this->s->removeElement($pregunta);
    }

    /**
     * Get pregunta
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreguntas()
    {
        return $this->preguntas;
    }

    /**
     * Set tipo
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Tipo $tipo
     * @return Registro
     */
    public function setTipo(\Sirepae\RegistrosEnfermeriaBundle\Entity\Tipo $tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\Tipo 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    
    public function __toString() {
        return $this->getNombre();
    }
}