<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\RegistrosEnfermeriaBundle\Repository\EstudianteRepository")
 */
class Estudiante
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", length=12, nullable=false)
     */
    private $codigo;

    /** 
     * @ORM\Column(type="smallint", length=2, nullable=true)
     */
    private $semestre;

    /** 
     * @ORM\OneToOne(targetEntity="\Sirepae\UsuariosBundle\Entity\Usuario", inversedBy="estudiantes", cascade={"all"})
     * @ORM\JoinColumn(name="estudiante_id", referencedColumnName="id", nullable=false, unique=true)
     */
    private $usuario;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\PAE", mappedBy="estudiante")
     */
    private $planesCuidado;

    /** 
     * @ORM\OneToMany(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria", 
     *     mappedBy="estudiante"
     * )
     */
    private $registrosEnfermeria;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PracticasBundle\Entity\Practica", inversedBy="estudiantes")
     * @ORM\JoinColumn(name="practica_id", referencedColumnName="id", nullable=false)
     */
    private $practica;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuario = new \Sirepae\UsuariosBundle\Entity\Usuario();
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
     * Set codigo
     *
     * @param string $codigo
     * @return Estudiante
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set semestre
     *
     * @param integer $semestre
     * @return Estudiante
     */
    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;
    
        return $this;
    }

    /**
     * Get semestre
     *
     * @return integer 
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * Set estudiante
     *
     * @param \Sirepae\UsuariosBundle\Entity\Usuario $usuario
     * @return Estudiante
     */
    public function setUsuario(\Sirepae\UsuariosBundle\Entity\Usuario $usuario)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get estudiante
     *
     * @return \Sirepae\UsuariosBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add planesCuidado
     *
     * @param \Sirepae\PAEBundle\Entity\PAE $planesCuidado
     * @return Estudiante
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
     * @return Estudiante
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

    /**
     * Set practica
     *
     * @param \Sirepae\PracticasBundle\Entity\Practica $practica
     * @return Estudiante
     */
    public function setPractica(\Sirepae\PracticasBundle\Entity\Practica $practica)
    {
        $this->practica = $practica;
    
        return $this;
    }

    /**
     * Get practica
     *
     * @return \Sirepae\PracticasBundle\Entity\Practica 
     */
    public function getPractica()
    {
        return $this->practica;
    }
    
    public function getNombre(){
        $nombre = $this->getUsuario()->getFullNombre();
        if(is_null($nombre) || empty($nombre))
            $nombre = $this->getUsuario()->getUsername();
        return $nombre;
    }
    
    public function __toString() {
        return $this->getUsuario()->__toString().'('.$this->getCodigo().')';
    }
}