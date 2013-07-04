<?php

/**
 *
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\GenealogyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IDCI\Bundle\GenealogyBundle\Entity\Genealogy
 *
 * @ORM\Table(name="genealogy")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\GenealogyBundle\Repository\GenealogyRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Element", inversedBy="mothers") 
     * @ORM\JoinColumn(name="mother_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $mother;
    
    /**
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Element", inversedBy="fathers")
     * @ORM\JoinColumn(name="father_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $father;
    
    /**
     * @ORM\OneToOne(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Element")
     * @ORM\JoinColumn(name="child_id", referencedColumnName="id", unique=true, onDelete="CASCADE")
     */
    private $child;

    /**
     * Genealogy to string
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s [%s, %s]",
            $this->getChild(),
            $this->getMother(),
            $this->getFather()
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
     * Set mother
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Element $mother
     * @return Genealogy
     */
    public function setMother(\IDCI\Bundle\GenealogyBundle\Entity\Element $mother)
    {
        $this->mother = $mother;
    
        return $this;
    }

    /**
     * Get mother
     *
     * @return IDCI\Bundle\GenealogyBundle\Entity\Element 
     */
    public function getMother()
    {
        return $this->mother;
    }

    /**
     * Set father
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Element $father
     * @return Genealogy
     */
    public function setFather(\IDCI\Bundle\GenealogyBundle\Entity\Element $father)
    {
        $this->father = $father;
    
        return $this;
    }

    /**
     * Get father
     *
     * @return IDCI\Bundle\GenealogyBundle\Entity\Element 
     */
    public function getFather()
    {
        return $this->father;
    }

    /**
     * Set child
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Element $child
     * @return Genealogy
     */
    public function setChild(\IDCI\Bundle\GenealogyBundle\Entity\Element $child = null)
    {
        $this->child = $child;
    
        return $this;
    }

    /**
     * Get child
     *
     * @return IDCI\Bundle\GenealogyBundle\Entity\Element 
     */
    public function getChild()
    {
        return $this->child;
    }

}
