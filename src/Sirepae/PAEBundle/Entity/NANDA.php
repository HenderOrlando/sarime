<?php
namespace Sirepae\PAEBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity(repositoryClass="\Sirepae\PAEBundle\Repository\NANDARepository")
 */
class NANDA extends \Sirepae\PAEBundle\Entity\Libro
{
    /** 
     * @ORM\OneToMany(targetEntity="\Sirepae\PAEBundle\Entity\Dominio", mappedBy="NANDA")
     */
    private $dominios;
    
    
    /******************* MÉTODOS *******************/
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->dominios = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add dominios
     *
     * @param \Sirepae\PAEBundle\Entity\Dominio $dominios
     * @return NANDA
     */
    public function addDominio(\Sirepae\PAEBundle\Entity\Dominio $dominios)
    {
        $this->dominios[] = $dominios;
    
        return $this;
    }

    /**
     * Remove dominios
     *
     * @param \Sirepae\PAEBundle\Entity\Dominio $dominios
     */
    public function removeDominio(\Sirepae\PAEBundle\Entity\Dominio $dominios)
    {
        $this->dominios->removeElement($dominios);
    }

    /**
     * Get dominios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDominios()
    {
        return $this->dominios;
    }
}