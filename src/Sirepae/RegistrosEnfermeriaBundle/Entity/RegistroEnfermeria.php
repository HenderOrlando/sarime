<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\RegistrosEnfermeriaBundle\Repository\RegistroEnfermeriaRepository")
 */
class RegistroEnfermeria
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToMany(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Nota", 
     *     mappedBy="registroEnfermeria", 
     *     cascade={"all"}
     * )
     * @ORM\OrderBy({"fecha_creado"="ASC"})
     */
    private $notas;

    /** 
     * @ORM\OneToMany(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria", 
     *     mappedBy="registroEnfermeria"
     * )
     */
    private $respuestas;

    /** 
     * @ORM\ManyToOne(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante", 
     *     inversedBy="registrosEnfermeria"
     * )
     * @ORM\JoinColumn(name="estudiante_id", referencedColumnName="id", nullable=false)
     */
    private $estudiante;

    /** 
     * @ORM\ManyToOne(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Paciente", 
     *     inversedBy="registrosEnfermeria"
     * )
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id", nullable=false)
     */
    private $paciente;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->notas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->respuestas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return RegistroEnfermeria
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
     * Add notas
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Nota $notas
     * @return RegistroEnfermeria
     */
    public function addNota(\Sirepae\RegistrosEnfermeriaBundle\Entity\Nota $notas)
    {
        $this->notas[] = $notas;
    
        return $this;
    }

    /**
     * Remove notas
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Nota $notas
     */
    public function removeNota(\Sirepae\RegistrosEnfermeriaBundle\Entity\Nota $notas)
    {
        $this->notas->removeElement($notas);
    }

    /**
     * Get notas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * Add respuestas
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria $respuestas
     * @return RegistroEnfermeria
     */
    public function addRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria $respuestas)
    {
        $this->respuestas[] = $respuestas;
    
        return $this;
    }

    /**
     * Remove respuestas
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria $respuestas
     */
    public function removeRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria $respuestas)
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
     * Set estudiante
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante $estudiante
     * @return RegistroEnfermeria
     */
    public function setEstudiante(\Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante $estudiante)
    {
        $this->estudiante = $estudiante;
    
        return $this;
    }

    /**
     * Get estudiante
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante 
     */
    public function getEstudiante()
    {
        return $this->estudiante;
    }

    /**
     * Set paciente
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Paciente $paciente
     * @return RegistroEnfermeria
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
    
    public function getNombre(){
        return 'Registro del Estudiante '.$this->getEstudiante().' al Paciente '.$this->getPaciente();
    }
}