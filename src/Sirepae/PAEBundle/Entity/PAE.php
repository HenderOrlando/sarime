<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\PAERepository")
 */
class PAE
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $val_objetiva;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $val_subjetiva;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $evaluacion;

    /** 
     * @ORM\Column(nullable=true)
     */
    private $objetivo;

    /** 
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_creado;

    /** 
     * @ORM\OneToOne(targetEntity="\Sirepae\PAEBundle\Entity\Calificacion", mappedBy="PAE", cascade={"all"})
     */
    private $calificacion;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\ActividadPAE", mappedBy="planCuidado")
     */
    private $actividades;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\DiagnosticoPAE", mappedBy="planCuidado")
     */
    private $diagnosticos;

    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\IndicadorPAE", mappedBy="planCuidado")
     */
    private $indicadores;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Paciente", inversedBy="planesCuidado")
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id", nullable=false)
     */
    private $paciente;

    /** 
     * @ORM\ManyToOne(targetEntity="\Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante", inversedBy="planesCuidado")
     * @ORM\JoinColumn(name="estudiante_id", referencedColumnName="id", nullable=false)
     */
    private $estudiante;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setFechaCreado(new \DateTime('now'));
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->diagnosticos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->indicadores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->calificacion = null;
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
     * Set val_objetiva
     *
     * @param string $valObjetiva
     * @return PAE
     */
    public function setValObjetiva($valObjetiva)
    {
        $this->val_objetiva = $valObjetiva;
    
        return $this;
    }

    /**
     * Get val_objetiva
     *
     * @return string 
     */
    public function getValObjetiva()
    {
        return $this->val_objetiva;
    }

    /**
     * Set val_subjetiva
     *
     * @param string $valSubjetiva
     * @return PAE
     */
    public function setValSubjetiva($valSubjetiva)
    {
        $this->val_subjetiva = $valSubjetiva;
    
        return $this;
    }

    /**
     * Get val_subjetiva
     *
     * @return string 
     */
    public function getValSubjetiva()
    {
        return $this->val_subjetiva;
    }

    /**
     * Set evaluacion
     *
     * @param string $evaluacion
     * @return PAE
     */
    public function setEvaluacion($evaluacion)
    {
        $this->evaluacion = $evaluacion;
    
        return $this;
    }

    /**
     * Get evaluacion
     *
     * @return string 
     */
    public function getEvaluacion()
    {
        return $this->evaluacion;
    }

    /**
     * Set objetivo
     *
     * @param string $objetivo
     * @return PAE
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;
    
        return $this;
    }

    /**
     * Get objetivo
     *
     * @return string 
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set fecha_creado
     *
     * @param \DateTime $fechaCreado
     * @return PAE
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
     * Set calificacion
     *
     * @param \Sirepae\PAEBundle\Entity\Calificacion $calificacion
     * @return PAE
     */
    public function setCalificacion(\Sirepae\PAEBundle\Entity\Calificacion $calificacion = null)
    {
        $this->calificacion = $calificacion;
    
        return $this;
    }

    /**
     * Get calificacion
     *
     * @return \Sirepae\PAEBundle\Entity\Calificacion 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }
    
    /**
     * Is calificado
     *
     * @return boolean
     */
    public function isCalificado()
    {
        return $this->calificacion && $this->calificacion != null && !empty($this->calificacion);
    }

    /**
     * Add actividades
     *
     * @param \Sirepae\PAEBundle\Entity\ActividadPAE $actividades
     * @return PAE
     */
    public function addActividade(\Sirepae\PAEBundle\Entity\ActividadPAE $actividades)
    {
        $this->actividades[] = $actividades;
    
        return $this;
    }

    /**
     * Exist actividades
     *
     * @param \Sirepae\PAEBundle\Entity\Actividad $actividad
     * @return boolean
     */
    public function existActividad(\Sirepae\PAEBundle\Entity\Actividad $actividad)
    {
        return $this->actividades->exists(function($key, ActividadPAE $actividadPAE) use ($actividad){
            return $actividadPAE->getActividad()->getId() == $actividad->getId();
        });
    }
    
    /**
     * Remove actividades
     *
     * @param \Sirepae\PAEBundle\Entity\ActividadPAE $actividades
     */
    public function removeActividade(\Sirepae\PAEBundle\Entity\ActividadPAE $actividades)
    {
        $this->actividades->removeElement($actividades);
    }

    /**
     * Get actividades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActividades()
    {
        return $this->actividades;
    }

    /**
     * Add diagnosticos
     *
     * @param \Sirepae\PAEBundle\Entity\DiagnosticoPAE $diagnosticos
     * @return PAE
     */
    public function addDiagnostico(\Sirepae\PAEBundle\Entity\DiagnosticoPAE $diagnosticos)
    {
        $this->diagnosticos[] = $diagnosticos;
    
        return $this;
    }
    
    /**
     * Exist evidencia diagnosticos
     *
     * @param \Sirepae\PAEBundle\Entity\Evidencia $evidencia
     * @param \Sirepae\PAEBundle\Entity\Diagnostico $diagnostico
     * @return boolean
     */
    public function existEvidenciaDiagnostico(\Sirepae\PAEBundle\Entity\Evidencia $evidencia, \Sirepae\PAEBundle\Entity\DiagnosticoPAE $diagnostico = null)
    {
        if(is_null($diagnostico)){
            foreach($this->diagnosticos as $diagnostico){
                if($diagnostico->existEvidencia($evidencia)){
                    return true;
                }
            }
        }else{
            return $diagnostico->existEvidencia($evidencia);
        }
        return false;
    }
    
    /**
     * Exist factorRelacionado diagnosticos
     *
     * @param \Sirepae\PAEBundle\Entity\Diagnostico $diagnostico
     * @param \Sirepae\PAEBundle\Entity\FactorRelacionado $factorRelacionado
     * @return boolean
     */
    public function existFactorRelacionadoDiagnostico(\Sirepae\PAEBundle\Entity\FactorRelacionado $factorRelacionado, \Sirepae\PAEBundle\Entity\DiagnosticoPAE $diagnostico = null)
    {
        if(is_null($diagnostico)){
            foreach($this->diagnosticos as $diagnostico){
                if($diagnostico->existFactorRelacionado($factorRelacionado)){
                    return true;
                }
            }
        }else{
            return $diagnostico->existFactorRelacionado($factorRelacionado);
        }
        return false;
    }
    
    /**
     * Exist diagnosticos
     *
     * @param \Sirepae\PAEBundle\Entity\Diagnostico $diagnostico
     * @return boolean
     */
    public function existDiagnostico(\Sirepae\PAEBundle\Entity\Diagnostico $diagnostico)
    {
        return $this->diagnosticos->exists(function($key, DiagnosticoPAE $diagnosticoPAE) use ($diagnostico){
            return $diagnosticoPAE->getDiagnostico()->getId() == $diagnostico->getId();
        });
    }

    /**
     * Remove diagnosticos
     *
     * @param \Sirepae\PAEBundle\Entity\DiagnosticoPAE $diagnosticos
     */
    public function removeDiagnostico(\Sirepae\PAEBundle\Entity\DiagnosticoPAE $diagnosticos)
    {
        $this->diagnosticos->removeElement($diagnosticos);
    }

    /**
     * Get diagnosticos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiagnosticos()
    {
        return $this->diagnosticos;
    }

    /**
     * Add indicadores
     *
     * @param \Sirepae\PAEBundle\Entity\IndicadorPAE $indicadores
     * @return PAE
     */
    public function addIndicadore(\Sirepae\PAEBundle\Entity\IndicadorPAE $indicadores)
    {
        $this->indicadores[] = $indicadores;
    
        return $this;
    }

    /**
     * Exist indicadores
     *
     * @param \Sirepae\PAEBundle\Entity\Indicador $indicador
     * @return boolean
     */
    public function existIndicador(\Sirepae\PAEBundle\Entity\Indicador $indicador, \Sirepae\PAEBundle\Entity\Escala $escala = null)
    {
        return $this->indicadores->exists(function($key, IndicadorPAE $indicadorPAE) use ($indicador, $escala){
            if(is_null($escala)){
                return $indicadorPAE->getIndicador()->getId() == $indicador->getId();
            }
            return $indicadorPAE->getIndicador()->getId() == $indicador->getId() && $indicadorPAE->getEscala()->getId() == $escala->getId();
        });
    }

    /**
     * Remove indicadores
     *
     * @param \Sirepae\PAEBundle\Entity\IndicadorPAE $indicadores
     */
    public function removeIndicadore(\Sirepae\PAEBundle\Entity\IndicadorPAE $indicadores)
    {
        $this->indicadores->removeElement($indicadores);
    }

    /**
     * Get indicadores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIndicadores()
    {
        return $this->indicadores;
    }

    /**
     * Set paciente
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Paciente $paciente
     * @return PAE
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

    /**
     * Set estudiante
     *
     * @param \Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante $estudiante
     * @return PAE
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
    
    public function __toString() {
        return 'Proceso de Atención de Enfermería de '.$this->getEstudiante()->getNombre().' ('.$this->getEstudiante()->getCodigo().') para el paciente '.$this->getPaciente()->getFullName().' ('.$this->getPaciente()->getCedula().')';
    }
    
    public function getFactoresRelacionados(Diagnostico $diag = null){
        $factores = array();
        if(is_null($diag)){
            foreach($this->diagnosticos as $diag){
                foreach($diag->getFactorRelacionados() as $e){
                    $factores[$e->getId()] = $e;
                }
            }
        }else{
            $diag_ = null;
            foreach($this->diagnosticos as $diagnostico){
                if($diagnostico->getDiagnostico()->getId() == $diag->getId()){
                    $diag_ = $diagnostico;
                    break;
                }
            }
            if(!is_null($diag_)){
                foreach($diag_->getFactorRelacionados() as $e){
                    if($e->getDiagnostico()->getId() == $diag->getId())
                        $factores[$e->getId()] = $e;
                }
            }
        }
        return $factores;
    }
    public function getEvidencias(Diagnostico $diag = null){
        $evidencias = array();
        if(is_null($diag)){
            foreach($this->diagnosticos as $diag){
                foreach($diag->getEvidencias() as $e){
                    $evidencias[$e->getId()] = $e;
                }
            }
        }else{
            $diag_ = null;
            foreach($this->diagnosticos as $diagnostico){
                if($diagnostico->getDiagnostico()->getId() == $diag->getId()){
                    $diag_ = $diagnostico;
                    break;
                }
            }
            if(!is_null($diag_)){
                foreach($diag_->getEvidencias() as $e){
                    if($e->getDiagnostico()->getId() == $diag->getId())
                        $evidencias[$e->getId()] = $e;
                }
            }
        }
        return $evidencias;
    }
    public function getEvidenciasFactoresRelacionados(){
        return \array_merge($this->getEvidencias(),$this->getFactoresRelacionados());
    }
}