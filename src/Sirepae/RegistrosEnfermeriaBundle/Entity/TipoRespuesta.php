<?php
namespace Sirepae\RegistrosEnfermeriaBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\RegistrosEnfermeriaBundle\Repository\TipoRespuestaRepository")
 */
class TipoRespuesta
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $nombre;

    /** 
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    private $tipo_campo;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToMany(
     *     targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta", 
     *     mappedBy="tipoRespuesta"
     * )
     */
    private $respuestas;
    
    private $nombres_tipo_campos;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->respuestas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->nombres_tipo_campos = array(
            'textarea'  => 'Texto', 
            'number'    => 'Número',
            'date'      => 'Fecha', 
            'time'      => 'Hora',
            'datetime'  => 'Fecha y Hora', 
        );
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
     * @return TipoRespuesta
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
     * Set tipo_campo
     *
     * @param string $tipoCampo
     * @return TipoRespuesta
     */
    public function setTipoCampo($tipoCampo)
    {
        $this->tipo_campo = $tipoCampo;
    
        return $this;
    }

    /**
     * Get tipo_campo
     *
     * @return string 
     */
    public function getTipoCampo(){
        return $this->tipo_campo;
    }

    /**
     * Get tipo_campo
     *
     * @return string 
     */
    public function getNombreTipoCampo(){
        return $this->nombres_tipo_campos[$this->tipo_campo];
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return TipoRespuesta
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
     * Add respuestas
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta $respuestas
     * @return TipoRespuesta
     */
    public function addRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta $respuestas)
    {
        $this->respuestas[] = $respuestas;
    
        return $this;
    }

    /**
     * Remove respuestas
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta $respuestas
     */
    public function removeRespuesta(\Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta $respuestas)
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
    
    public function __toString() {
        return $this->getNombre();
    }
}