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
 * IDCI\Bundle\GenealogyBundle\Entity\Element
 */
abstract class Element
{   
    /**
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Element", inversedBy="fatherChildren")
     * @ORM\JoinColumn(name="father_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $father;

    /**
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Element", inversedBy="motherChildren")
     * @ORM\JoinColumn(name="mother_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $mother;
    
    /**
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Element", mappedBy="mother")
     */
    protected $motherChildren;

    /**
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Element", mappedBy="father")
     */
    protected $fatherChildren;
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    protected $name;

    /**
     * @var \DateTime $birth_date
     *
     * @ORM\Column(name="birth_date", type="datetime")
     */
    protected $birthDate;

    /**
     * @var string $sex
     *
     * @ORM\Column(name="sex", type="string", length=1)
     */
    protected $sex;

    /**
     * Element to string
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf("(%d) %s",
            $this->getId(),
            $this->getName()
        );
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->motherChildren = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fatherChildren = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */    
    public function getChildren()
    {
        if ($this->sex == 'f') {
            return $this->getMotherChildren();
        } else {
            return $this->getFatherChildren();
        }
    }

    /**
     * Has mother
     * 
     * @return boolean
     */
    public function hasMother()
    {
        return ($this->getMother() != NULL) ? true : false;
    }

    /**
     * Has father
     * 
     * @return boolean
     */
    public function hasFather()
    {
        return ($this->getFather() != NULL) ? true : false;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Element
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     * @return Element
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    
        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return Element
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }  

    /**
     * Set father
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Element $father
     * @return Element
     */
    public function setFather(\IDCI\Bundle\GenealogyBundle\Entity\Element $father = null)
    {
        $this->father = $father;
    
        return $this;
    }

    /**
     * Get father
     *
     * @return \IDCI\Bundle\GenealogyBundle\Entity\Element 
     */
    public function getFather()
    {
        return $this->father;
    }

    /**
     * Set mother
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Element $mother
     * @return Element
     */
    public function setMother(\IDCI\Bundle\GenealogyBundle\Entity\Element $mother = null)
    {
        $this->mother = $mother;
    
        return $this;
    }

    /**
     * Get mother
     *
     * @return \IDCI\Bundle\GenealogyBundle\Entity\Element 
     */
    public function getMother()
    {
        return $this->mother;
    }
    
    /**
     * Add motherChildren
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Element $motherChildren
     * @return Element
     */
    public function addMotherChildren(\IDCI\Bundle\GenealogyBundle\Entity\Element $motherChildren)
    {
        $this->motherChildren[] = $motherChildren;
    
        return $this;
    }

    /**
     * Remove motherChildren
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Element $motherChildren
     */
    public function removeMotherChildren(\IDCI\Bundle\GenealogyBundle\Entity\Element $motherChildren)
    {
        $this->motherChildren->removeElement($motherChildren);
    }

    /**
     * Get motherChildren
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMotherChildren()
    {
        return $this->motherChildren;
    }

    /**
     * Add fatherChildren
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Element $fatherChildren
     * @return Element
     */
    public function addFatherChildren(\IDCI\Bundle\GenealogyBundle\Entity\Element $fatherChildren)
    {
        $this->fatherChildren[] = $fatherChildren;
    
        return $this;
    }

    /**
     * Remove fatherChildren
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Element $fatherChildren
     */
    public function removeFatherChildren(\IDCI\Bundle\GenealogyBundle\Entity\Element $fatherChildren)
    {
        $this->fatherChildren->removeElement($fatherChildren);
    }

    /**
     * Get fatherChildren
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFatherChildren()
    {
        return $this->fatherChildren;
    }
}