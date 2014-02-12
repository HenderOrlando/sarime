<?php
namespace Sirepae\PracticasBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="Sirepae\PracticasBundle\Repository\PracticaRepository")
 */
class Practica
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", unique=true, length=100, nullable=false)
     */
    private $nombre;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_modifica;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante", mappedBy="practica")
     */
    private $estudiantes;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PracticasBundle\Entity\Area", inversedBy="practicas")
     * @ORM\JoinColumn(name="area_practica_id", referencedColumnName="id", nullable=false)
     */
    private $areaPractica;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\UsuariosBundle\Entity\Usuario", inversedBy="docentesPractica")
     * @ORM\JoinColumn(name="docente_id", referencedColumnName="id", nullable=false)
     */
    private $docente;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\UsuariosBundle\Entity\Usuario", inversedBy="coordinadoresPractica")
     * @ORM\JoinColumn(name="coordinador_id", referencedColumnName="id", nullable=false)
     */
    private $coordinador;
    
    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\PracticasBundle\Entity\Sitio", inversedBy="practicas", cascade={"all"})
     * @ORM\JoinColumn(name="sitio_id", referencedColumnName="id", nullable=true)
     */
    private $sitio;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->setFechaModifica(new \DateTime('now'));
        $this->estudiantes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Practica
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        $this->setFechaModifica(new \DateTime('now'));
    
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Practica
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        $this->setFechaModifica(new \DateTime('now'));
    
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
     * @return Practica
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
     * Set fecha_modifica
     *
     * @param \DateTime $fechaModifica
     * @return Practica
     */
    public function setFechaModifica($fechaModifica)
    {
        $this->fecha_modifica = $fechaModifica;
    
        return $this;
    }

    /**
     * Get fecha_modifica
     *
     * @return \DateTime 
     */
    public function getFechaModifica()
    {
        return $this->fecha_modifica;
    }

    /**
     * Add estudiantes
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante $estudiantes
     * @return Practica
     */
    public function addEstudiante(\Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante $estudiantes)
    {
        $this->estudiantes[] = $estudiantes;
        $this->setFechaModifica(new \DateTime('now'));
    
        return $this;
    }

    /**
     * Remove estudiantes
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante $estudiantes
     */
    public function removeEstudiante(\Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante $estudiantes)
    {
        $this->estudiantes->removeElement($estudiantes);
        $this->setFechaModifica(new \DateTime('now'));
    }

    /**
     * Get estudiantes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstudiantes()
    {
        return $this->estudiantes;
    }

    /**
     * Set areaPractica
     *
     * @param \Sirepae\PracticasBundle\Entity\Area $areaPractica
     * @return Practica
     */
    public function setAreaPractica(\Sirepae\PracticasBundle\Entity\Area $areaPractica)
    {
        $this->areaPractica = $areaPractica;
        $this->setFechaModifica(new \DateTime('now'));
    
        return $this;
    }

    /**
     * Get areaPractica
     *
     * @return \Sirepae\PracticasBundle\Entity\Area 
     */
    public function getAreaPractica()
    {
        return $this->areaPractica;
    }

    /**
     * Set docente
     *
     * @param \Sirepae\UsuariosBundle\Entity\Usuario $docente
     * @return Practica
     */
    public function setDocente(\Sirepae\UsuariosBundle\Entity\Usuario $docente)
    {
        $this->docente = $docente;
        $this->setFechaModifica(new \DateTime('now'));
    
        return $this;
    }

    /**
     * Get docente
     *
     * @return \Sirepae\UsuariosBundle\Entity\Usuario 
     */
    public function getDocente()
    {
        return $this->docente;
    }

    /**
     * Set coordinador
     *
     * @param \Sirepae\UsuariosBundle\Entity\Usuario $coordinador
     * @return Practica
     */
    public function setCoordinador(\Sirepae\UsuariosBundle\Entity\Usuario $coordinador)
    {
        $this->coordinador = $coordinador;
        $this->setFechaModifica(new \DateTime('now'));
    
        return $this;
    }

    /**
     * Get coordinador
     *
     * @return \Sirepae\UsuariosBundle\Entity\Usuario 
     */
    public function getCoordinador()
    {
        return $this->coordinador;
    }
    
    /**
     * Set sitio
     *
     * @param \Sirepae\PracticasBundle\Entity\Sitio $sitio
     * @return Sitio
     */
    public function setSitio(\Sirepae\PracticasBundle\Entity\Sitio $sitio)
    {
        $this->sitio = $sitio;
    
        return $this;
    }

    /**
     * Get sitio
     *
     * @return \Sirepae\PracticasBundle\Entity\Sitio 
     */
    public function getSitio()
    {
        return $this->sitio;
    }
    
    public function __toString() {
        return $this->getNombre().'('.$this->getCoordinador()->getFullNombre().')';
    }
}