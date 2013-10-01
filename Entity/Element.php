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
 *
 * @ORM\Entity(repositoryClass="IDCI\Bundle\GenealogyBundle\Repository\ElementRepository")
 * @ORM\Table(name="element")
 */
class Element
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Element", inversedBy="fatherChildren")
     * @ORM\JoinColumn(name="father_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $father;

    /**
     * @ORM\ManyToOne(targetEntity="Element", inversedBy="motherChildren")
     * @ORM\JoinColumn(name="mother_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $mother;
    
    /**
     * @ORM\OneToMany(targetEntity="Element", mappedBy="mother")
     */
    protected $motherChildren;

    /**
     * @ORM\OneToMany(targetEntity="Element", mappedBy="father")
     */
    protected $fatherChildren;

    /**
     * @ORM\ManyToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Role")
     */
    protected $roles;
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var \DateTime $birth_date
     *
     * @ORM\Column(name="birth_date", type="datetime")
     */
    protected $birthDate;

    /**
     * @var integer $size
     *
     * @ORM\Column(name="size", type="integer")
     */
    protected $size;

    /**
     * @var integer $weight
     *
     * @ORM\Column(name="weight", type="integer", nullable=true)
     */
    protected $weight;

    /**
     * @var string $sex
     *
     * @ORM\Column(name="sex", type="string", length=1)
     */
    protected $sex;

    /**
     * @var integer $rank
     *
     * @ORM\Column(name="rank", type="integer")
     */
    protected $rank;

    /**
     * @var string $coat_color
     *
     * @ORM\Column(name="coat_color", type="string", length=255)
     */
    protected $coatColor;

    /**
     * Genealogy to string
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
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set size
     *
     * @param integer $size
     * @return Element
     */
    public function setSize($size)
    {
        $this->size = $size;
    
        return $this;
    }

    /**
     * Get size
     *
     * @return integer 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return Element
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    
        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
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
     * Set rank
     *
     * @param integer $rank
     * @return Element
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    
        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set coatColor
     *
     * @param string $coatColor
     * @return Element
     */
    public function setCoatColor($coatColor)
    {
        $this->coatColor = $coatColor;
    
        return $this;
    }

    /**
     * Get coatColor
     *
     * @return string 
     */
    public function getCoatColor()
    {
        return $this->coatColor;
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

    /**
     * Add roles
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Role $roles
     * @return Element
     */
    public function addRole(\IDCI\Bundle\GenealogyBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;
    
        return $this;
    }

    /**
     * Remove roles
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Role $roles
     */
    public function removeRole(\IDCI\Bundle\GenealogyBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }
}