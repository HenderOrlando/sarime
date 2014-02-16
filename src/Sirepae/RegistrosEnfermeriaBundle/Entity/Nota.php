<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\RegistrosEnfermeriaBundle\Repository\NotaRepository")
 */
class Nota
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
    private $nota;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria", inversedBy="notas")
     * @ORM\JoinColumn(name="registro_enfermeria_id", referencedColumnName="id", nullable=false)
     */
    private $registroEnfermeria;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\UsuariosBundle\Entity\Usuario", inversedBy="notas")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=true)
     */
    private $usuario;
    
    
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
     * Set nota
     *
     * @param string $nota
     * @return Nota
     */
    public function setNota($nota)
    {
        $this->nota = $nota;
    
        return $this;
    }

    /**
     * Get nota
     *
     * @return string 
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Nota
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
     * Set registroEnfermeria
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria $registroEnfermeria
     * @return Nota
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

    /**
     * Set usuario
     *
     * @param \Sirepae\UsuariosBundle\Entity\Usuario $usuario
     * @return Nota
     */
    public function setUsuario(\Sirepae\UsuariosBundle\Entity\Usuario $usuario)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Sirepae\UsuariosBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}