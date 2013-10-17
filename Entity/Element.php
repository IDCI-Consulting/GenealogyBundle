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
    protected $father;

    /**
     * @ORM\ManyToOne(targetEntity="Element", inversedBy="motherChildren")
     * @ORM\JoinColumn(name="mother_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $mother;
    
    /**
     * @ORM\OneToMany(targetEntity="Element", mappedBy="mother")
     */
    protected $motherChildren;

    /**
     * @ORM\OneToMany(targetEntity="Element", mappedBy="father")
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
     * @var integer $size
     *
     * @ORM\Column(name="size", type="integer")
     */
    protected $size;

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
     * @var integer $weight
     *
     * @ORM\Column(name="weight", type="integer", nullable=true)
     */
    protected $weight;

    /**
     * @ORM\ManyToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Role", inversedBy="elements"))
     */
    protected $roles;

    /**
     * @ORM\ManyToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Media", inversedBy="elements")
     */
    protected $medias;

    /**
     * @ORM\ManyToOne(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Race", inversedBy="elements")
     * @ORM\JoinColumn(name="race_id", referencedColumnName="id", nullable=false)
     */
    protected $race;

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

    /**
     * Add media
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Media $media
     * @return Element
     */
    public function addMedia(\IDCI\Bundle\GenealogyBundle\Entity\Media $media)
    {
        $this->medias[] = $media;

        return $this;
    }

    /**
     * Remove media
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Media $media
     */
    public function removeMedia(\IDCI\Bundle\GenealogyBundle\Entity\Media $media)
    {
        $this->media->removeElement($media);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Add roles
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Role $role
     * @return Element
     */
    public function addRole(\IDCI\Bundle\GenealogyBundle\Entity\Role $role)
    {
        $this->roles[] = $role;
    
        return $this;
    }

    /**
     * Remove roles
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Role $role
     */
    public function removeRole(\IDCI\Bundle\GenealogyBundle\Entity\Role $role)
    {
        $this->roles->removeElement($role);
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
     * Set race
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Race $race
     * @return Element
     */
    public function setRace(\IDCI\Bundle\GenealogyBundle\Entity\Race $race = null)
    {
        $this->race = $race;
    
        return $this;
    }

    /**
     * Get races
     *
     * @return \IDCI\Bundle\GenealogyBundle\Entity\Race 
     */
    public function getRace()
    {
        return $this->race;
    }
}