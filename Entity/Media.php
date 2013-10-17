<?php

/**
 *
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\GenealogyBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * IDCI\Bundle\GenealogyBundle\Entity\Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Media
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
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;
    
    /**
     * @ORM\ManyToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Element", mappedBy="medias")
     */
    private $elements;

    /**
     * @var datetime $updated_at
     * 
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;
    
    /**
     * Media to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getPath();
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->elements = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set path
     *
     * @param string $path
     * @return Media
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Add elements
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Element $elements
     * @return Media
     */
    public function addElement(\IDCI\Bundle\GenealogyBundle\Entity\Element $elements)
    {
        $this->elements[] = $elements;
    
        return $this;
    }

    /**
     * Remove elements
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Element $elements
     */
    public function removeElement(\IDCI\Bundle\GenealogyBundle\Entity\Element $elements)
    {
        $this->elements->removeElement($elements);
    }

    /**
     * Get elements
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getElements()
    {
        return $this->elements;
    }
    
     public function getAbsolutePath()
    {
        return null === $this->path ? null : self::getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : self::getUploadDir().'/'.$this->path;
    }

    public static function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../../web'.self::getUploadDir();
    }

    public static function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return '/uploads';
    }

    /**
     * @ORM\PreUpdate()
     */
    public function cleanFile()
    {
      if ($file = $this->getAbsolutePath()) {
        unlink($file);
      }
    }
    
    
    /**
     * @ORM\PreUpdate()
     * @ORM\PrePersist()
     */
    public function preUpload()
    {
        $this->setUpdatedAt(new \DateTime('now'));
        
        if (null !== $this->file) {
            $this->path = $this->getFileName();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->file) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and then the target filename to move to
        $this->file->move(self::getUploadRootDir(), $this->getFileName());

        // set the path property to the filename where you'ved saved the file
        $this->path = $this->getFileName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    public function getFileName()
    {
      return sprintf("%s_%s", time(), $this->file->getClientOriginalName());
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Media
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}