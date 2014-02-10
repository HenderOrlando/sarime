<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\NICRepository")
 */
class NIC extends \Sirepae\PAEBundle\Entity\Libro
{
    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\Intervencion", mappedBy="nIC")
     */
    private $intervenciones;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->intervenciones = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add intervenciones
     *
     * @param \Sirepae\PAEBundle\Entity\Intervencion $intervenciones
     * @return NIC
     */
    public function addIntervencione(\Sirepae\PAEBundle\Entity\Intervencion $intervenciones)
    {
        $this->intervenciones[] = $intervenciones;
    
        return $this;
    }

    /**
     * Remove intervenciones
     *
     * @param \Sirepae\PAEBundle\Entity\Intervencion $intervenciones
     */
    public function removeIntervencione(\Sirepae\PAEBundle\Entity\Intervencion $intervenciones)
    {
        $this->intervenciones->removeElement($intervenciones);
    }

    /**
     * Get intervenciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIntervenciones()
    {
        return $this->intervenciones;
    }
}