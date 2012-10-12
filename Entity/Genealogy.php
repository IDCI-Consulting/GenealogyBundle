<?php

namespace IDCI\GenealogyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IDCI\GenealogyBundle\Entity\Genealogy
 *
 * @ORM\Table(name="genealogy")
 * @ORM\Entity(repositoryClass="IDCI\GenealogyBundle\Repository\GenealogyRepository")
 */
class Genealogy
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="IDCI\GenealogyBundle\Entity\Element", inversedBy="mothers") 
     * @ORM\JoinColumn(name="mother_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $mother;
    
    /**
     * @ORM\ManyToOne(targetEntity="IDCI\GenealogyBundle\Entity\Element", inversedBy="fathers")
     * @ORM\JoinColumn(name="father_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $father;
    
    /**
     * @ORM\OneToOne(targetEntity="IDCI\GenealogyBundle\Entity\Element")
     * @ORM\JoinColumn(name="child_id", referencedColumnName="id", unique=true, onDelete="CASCADE")
     */
    private $child;


    

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
     * Set mother
     *
     * @param IDCI\GenealogyBundle\Entity\Element $mother
     * @return Genealogy
     */
    public function setMother(\IDCI\GenealogyBundle\Entity\Element $mother)
    {
        $this->mother = $mother;
    
        return $this;
    }

    /**
     * Get mother
     *
     * @return IDCI\GenealogyBundle\Entity\Element 
     */
    public function getMother()
    {
        return $this->mother;
    }

    /**
     * Set father
     *
     * @param IDCI\GenealogyBundle\Entity\Element $father
     * @return Genealogy
     */
    public function setFather(\IDCI\GenealogyBundle\Entity\Element $father)
    {
        $this->father = $father;
    
        return $this;
    }

    /**
     * Get father
     *
     * @return IDCI\GenealogyBundle\Entity\Element 
     */
    public function getFather()
    {
        return $this->father;
    }

    /**
     * Set child
     *
     * @param IDCI\GenealogyBundle\Entity\Element $child
     * @return Genealogy
     */
    public function setChild(\IDCI\GenealogyBundle\Entity\Element $child = null)
    {
        $this->child = $child;
    
        return $this;
    }

    /**
     * Get child
     *
     * @return IDCI\GenealogyBundle\Entity\Element 
     */
    public function getChild()
    {
        return $this->child;
    }
    
}