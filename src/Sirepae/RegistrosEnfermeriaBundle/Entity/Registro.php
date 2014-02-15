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
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $aplicaEnPaciente;
    
    /** 
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $unico;
    
    /** 
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $tabla;

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
        $this->tabla = false;
        $this->unico = true;
        $this->aplicaEnPaciente = false;
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
     * Set aplicaEnPaciente
     *
     * @param boolean $aplicaEnPaciente
     * @return Registro
     */
    public function setAplicaEnPaciente($aplicaEnPaciente)
    {
        $this->aplicaEnPaciente = $aplicaEnPaciente;
    
        return $this;
    }

    /**
     * Get aplicaEnPaciente
     *
     * @return boolean 
     */
    public function getAplicaEnPaciente()
    {
        return $this->aplicaEnPaciente;
    }

    /**
     * Set unico
     *
     * @param boolean $unico
     * @return Registro
     */
    public function setUnico($unico)
    {
        $this->unico = $unico;
    
        return $this;
    }

    /**
     * Get unico
     *
     * @return boolean 
     */
    public function isUnico()
    {
        return $this->unico;
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
     * Get preguntas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreguntas()
    {
        return $this->preguntas;
    }

    /**
     * Get pregunta
     *
     * @return Pregunta El Objeto Pregunta si lo encuentra, NULL en los demás casos
     */
    public function getPregunta($id_pregunta)
    {
        foreach($this->preguntas as $preg){
            if($preg->getId() === $id_pregunta){
                return $preg;
            }
        }
        return null;
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
    
    /**
     * Set tabla
     *
     * @param boolean $tabla
     * @return Pregunta
     */
    public function setTabla($tabla)
    {
        $this->tabla = $tabla;
    
        return $this;
    }

    /**
     * Is tabla
     *
     * @return boolean 
     */
    public function isTabla()
    {
        return $this->tabla;
    }
    
    public function __toString() {
        return $this->getNombre();
    }
}