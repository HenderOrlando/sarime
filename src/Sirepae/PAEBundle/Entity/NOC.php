<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\NOCRepository")
 */
class NOC extends \Sirepae\PAEBundle\Entity\Libro
{
    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\ResultadoEsperado", mappedBy="NOC")
     */
    private $resultadosEsperados;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->resultadosEsperados = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add resultadosEsperados
     *
     * @param \Sirepae\PAEBundle\Entity\ResultadoEsperado $resultadosEsperados
     * @return NOC
     */
    public function addResultadosEsperado(\Sirepae\PAEBundle\Entity\ResultadoEsperado $resultadosEsperados)
    {
        $this->resultadosEsperados[] = $resultadosEsperados;
    
        return $this;
    }

    /**
     * Remove resultadosEsperados
     *
     * @param \Sirepae\PAEBundle\Entity\ResultadoEsperado $resultadosEsperados
     */
    public function removeResultadosEsperado(\Sirepae\PAEBundle\Entity\ResultadoEsperado $resultadosEsperados)
    {
        $this->resultadosEsperados->removeElement($resultadosEsperados);
    }

    /**
     * Get resultadosEsperados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResultadosEsperados()
    {
        return $this->resultadosEsperados;
    }
}