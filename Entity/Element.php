<?php

namespace IDCI\Bundle\GenealogyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IDCI\Bundle\GenealogyBundle\Entity\Element
 *
 * @ORM\Table(name="element")
 * @ORM\Entity(repositoryClass="IDCI\Bundle\GenealogyBundle\Repository\ElementRepository")
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
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Genealogy", mappedBy="mother")
     */
    private $mothers;
    
    /**
     * @ORM\OneToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Genealogy", mappedBy="father")
     */
    private $fathers;
    
    /**
     * @ORM\OneToOne(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Genealogy")
     * 
     */
    private $genealogy;
    
    /**
     * @ORM\ManyToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Role")
     */
    private $roles;
    
    /**
     * @ORM\ManyToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Media")
     */
    private $medias;
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime $birth_date
     *
     * @ORM\Column(name="birth_date", type="datetime")
     */
    private $birth_date;

    /**
     * @var integer $size
     *
     * @ORM\Column(name="size", type="integer")
     */
    private $size;

    /**
     * @var integer $weight
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var boolean $sex
     *
     * @ORM\Column(name="sex", type="boolean")
     */
    private $sex;

    /**
     * @var integer $rank
     *
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;

    /**
     * @var string $coat_color
     *
     * @ORM\Column(name="coat_color", type="string", length=255)
     */
    private $coat_color;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mothers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fathers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set birth_date
     *
     * @param \DateTime $birthDate
     * @return Element
     */
    public function setBirthDate($birthDate)
    {
        $this->birth_date = $birthDate;
    
        return $this;
    }

    /**
     * Get birth_date
     *
     * @return \DateTime 
     */
    public function getBirthDate()
    {
        return $this->birth_date;
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
     * @param boolean $sex
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
     * @return boolean 
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
     * Set coat_color
     *
     * @param string $coatColor
     * @return Element
     */
    public function setCoatColor($coatColor)
    {
        $this->coat_color = $coatColor;
    
        return $this;
    }

    /**
     * Get coat_color
     *
     * @return string 
     */
    public function getCoatColor()
    {
        return $this->coat_color;
    }

    /**
     * Add mothers
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Genealogy $mothers
     * @return Element
     */
    public function addMother(\IDCI\Bundle\GenealogyBundle\Entity\Genealogy $mothers)
    {
        $this->mothers[] = $mothers;
    
        return $this;
    }

    /**
     * Remove mothers
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Genealogy $mothers
     */
    public function removeMother(\IDCI\Bundle\GenealogyBundle\Entity\Genealogy $mothers)
    {
        $this->mothers->removeElement($mothers);
    }

    /**
     * Get mothers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMothers()
    {
        return $this->mothers;
    }

    /**
     * Add fathers
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Genealogy $fathers
     * @return Element
     */
    public function addFather(\IDCI\Bundle\GenealogyBundle\Entity\Genealogy $fathers)
    {
        $this->fathers[] = $fathers;
    
        return $this;
    }

    /**
     * Remove fathers
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Genealogy $fathers
     */
    public function removeFather(\IDCI\Bundle\GenealogyBundle\Entity\Genealogy $fathers)
    {
        $this->fathers->removeElement($fathers);
    }

    /**
     * Get fathers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFathers()
    {
        return $this->fathers;
    }

    /**
     * Add roles
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Role $roles
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
     * @param IDCI\Bundle\GenealogyBundle\Entity\Role $roles
     */
    public function removeRole(\IDCI\Bundle\GenealogyBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add medias
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Media $medias
     * @return Element
     */
    public function addMedia(\IDCI\Bundle\GenealogyBundle\Entity\Media $medias)
    {
        $this->medias[] = $medias;
    
        return $this;
    }

    /**
     * Remove medias
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Media $medias
     */
    public function removeMedia(\IDCI\Bundle\GenealogyBundle\Entity\Media $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Set genealogy
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Genealogy $genealogy
     * @return Element
     */
    public function setGenealogy(\IDCI\Bundle\GenealogyBundle\Entity\Genealogy $genealogy = null)
    {
        $this->genealogy = $genealogy;
    
        return $this;
    }

    /**
     * Get genealogy
     *
     * @return IDCI\Bundle\GenealogyBundle\Entity\Genealogy 
     */
    public function getGenealogy()
    {
        return $this->genealogy;
    }

    /**
     * Get Mother (proxy)
     *
     * @return IDCI\Bundle\GenealogyBundle\Entity\Element 
     */
    public function getMother()
    {
        if($this->getGenealogy())
            return $this->getGenealogy()->getMother();
        
        return null;
    }
    
    /**
     * Has Mother
     *
     * @return boolean
     */
    public function hasMother()
    {
        return $this->getMother() != null;
    }
    
    /**
     * Get Mother Id (proxy)
     *
     * @return integer
     */
    public function getMotherId()
    {
        if($this->getMother())
            return $this->getMother()->getId();
        
        return null;
    }    

    /**
     * Get Father (proxy)
     *
     * @return IDCI\Bundle\GenealogyBundle\Entity\Element 
     */
    public function getFather()
    {
        if($this->getGenealogy())
            return $this->getGenealogy()->getFather();
        
        return null;
    }
        
    /**
     * Has Father
     *
     * @return boolean
     */
    public function hasFather()
    {
        return $this->getFather() != null;
    }
    
    /**
     * Get Father Id (proxy)
     *
     * @return integer
     */
    public function getFatherId()
    {
        if($this->getFather())
            return $this->getFather()->getId();
        
        return null;
    }    

}