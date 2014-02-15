<?php
namespace Sirepae\UsuariosBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;
use FOS\UserBundle\Model\User as BaseUser;

/** 
 * @ORM\Entity(repositoryClass="Sirepae\UsuariosBundle\Repository\UsuarioRepository")
 */
class Usuario extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** 
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $nombres;

    /** 
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $apellidos;

    /** 
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $telefonos;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $direccion;

    /** 
     * @ORM\Column(type="bigint", nullable=false)
     */
    private $ingresos;

    /** 
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToOne(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante", mappedBy="usuario")
     */
    private $estudiantes;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PracticasBundle\Entity\Practica", mappedBy="docente")
     */
    private $docentesPractica;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PracticasBundle\Entity\Practica", mappedBy="coordinador")
     */
    private $coordinadoresPractica;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\Calificacion", mappedBy="docente", cascade={"all"})
     */
    private $calificaciones;
    
    /**
     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="usuarios")
     * @ORM\JoinColumn(name="rol_id", referencedColumnName="id", nullable=true)
     */
    protected $rol_usuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->ingresos = 0;
        $this->docentesPractica = new \Doctrine\Common\Collections\ArrayCollection();
        $this->coordinadoresPractica = new \Doctrine\Common\Collections\ArrayCollection();
        $this->calificaciones = new \Doctrine\Common\Collections\ArrayCollection();
        if(isset($this->rol_usuario) && method_exists($this->rol_usuario,'getRolName'))
            $this->addRole($this->rol_usuario->getNombre());
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
     * Set nombres
     *
     * @param string $nombres
     * @return Usuario
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    
        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Add ingreso
     *
     * @return Usuario
     */
    public function addIngreso()
    {
        $this->ingresos = $this->ingresos+1;
    
        return $this;
    }

    /**
     * Get ingresos
     *
     * @return integer 
     */
    public function getIngresos()
    {
        return $this->ingresos;
    }

    /**
     * Set rol_usuario
     *
     * @param Sirepae\UsuariosBundle\Entity\Rol $rol_usuario
     * @return Usuario
     */
    public function setRolUsuario(Rol $rol_usuario)
    {
        $this->rol_usuario = $rol_usuario;
        $this->addRole($rol_usuario->getNombre());
        return $this;
    }

    /**
     * Get rol_usuario
     *
     * @return \Sirepae\UsuariosBundle\Entity\Rol
     */
    public function getRolUsuario()
    {
        return $this->rol_usuario;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    
        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set telefonos
     *
     * @param string $telefonos
     * @return Usuario
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;
    
        return $this;
    }

    /**
     * Get telefonos
     *
     * @return string 
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Usuario
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return Usuario
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
     * Set username
     *
     * @param string $username
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Usuario
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set estudiantes
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante $estudiantes
     * @return Usuario
     */
    public function setEstudiantes(\Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante $estudiantes = null)
    {
        $this->estudiantes = $estudiantes;
    
        return $this;
    }

    /**
     * Get estudiantes
     *
     * @return \Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante 
     */
    public function getEstudiantes()
    {
        return $this->estudiantes;
    }

    /**
     * Add docentesPractica
     *
     * @param \Sirepae\PracticasBundle\Entity\Practica $docentesPractica
     * @return Usuario
     */
    public function addDocentesPractica(\Sirepae\PracticasBundle\Entity\Practica $docentesPractica)
    {
        $this->docentesPractica[] = $docentesPractica;
    
        return $this;
    }

    /**
     * Remove docentesPractica
     *
     * @param \Sirepae\PracticasBundle\Entity\Practica $docentesPractica
     */
    public function removeDocentesPractica(\Sirepae\PracticasBundle\Entity\Practica $docentesPractica)
    {
        $this->docentesPractica->removeElement($docentesPractica);
    }

    /**
     * Get docentesPractica
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocentesPractica()
    {
        return $this->docentesPractica;
    }

    /**
     * Add coordinadoresPractica
     *
     * @param \Sirepae\PracticasBundle\Entity\Practica $coordinadoresPractica
     * @return Usuario
     */
    public function addCoordinadoresPractica(\Sirepae\PracticasBundle\Entity\Practica $coordinadoresPractica)
    {
        $this->coordinadoresPractica[] = $coordinadoresPractica;
    
        return $this;
    }

    /**
     * Remove coordinadoresPractica
     *
     * @param \Sirepae\PracticasBundle\Entity\Practica $coordinadoresPractica
     */
    public function removeCoordinadoresPractica(\Sirepae\PracticasBundle\Entity\Practica $coordinadoresPractica)
    {
        $this->coordinadoresPractica->removeElement($coordinadoresPractica);
    }

    /**
     * Get coordinadoresPractica
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoordinadoresPractica()
    {
        return $this->coordinadoresPractica;
    }

    /**
     * Add calificaciones
     *
     * @param \Sirepae\PAEBundle\Entity\Calificacion $calificaciones
     * @return Usuario
     */
    public function addCalificacione(\Sirepae\PAEBundle\Entity\Calificacion $calificaciones)
    {
        $this->calificaciones[] = $calificaciones;
    
        return $this;
    }

    /**
     * Remove calificaciones
     *
     * @param \Sirepae\PAEBundle\Entity\Calificacion $calificaciones
     */
    public function removeCalificacione(\Sirepae\PAEBundle\Entity\Calificacion $calificaciones)
    {
        $this->calificaciones->removeElement($calificaciones);
    }

    /**
     * Get calificaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCalificaciones()
    {
        return $this->calificaciones;
    }
    
    /**
     * Agrega un rol al usuario.
     * @throws Exception
     * @param Rol $rol 
     */
    public function addRole( $rol )
    {
        $rol = str_replace(' ','_',strtoupper(str_replace('ROLE_', '', $rol)));
        if ($rol === static::ROLE_DEFAULT) {
            return $this;
        }

        if (!in_array('ROLE_'.$rol, $this->roles, true)) {
            $this->roles[] = 'ROLE_'.$rol;
        }
        return $this;
    }
    
    /**
     * Get expired at
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
    /**
     * Get expired
     *
     *
     * @return User
     */
    public function getExpired(){
        return $this->expired;
    }
    
    /**
     * @param \DateTime $date
     *
     * @return User
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }
    
    public function getFullNombre(){
        return $this->getNombres().' '.$this->getApellidos();
    }

    /**
     * @return boolean
     */
    public function getCredentialsExpired()
    {
        return $this->credentialsExpired;
    }
}