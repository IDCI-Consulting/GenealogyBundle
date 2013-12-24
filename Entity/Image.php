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
 * IDCI\Bundle\GenealogyBundle\Entity\Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image
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
     * @var string $name
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    
    /**
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * @ORM\ManyToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Element", mappedBy="images")
     */
    private $elements;

    /**
     * @var datetime $updated_at
     * 
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;

    /**
     * Image to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->elements = new \Doctrine\Common\Collections\ArrayCollection();
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
        return __DIR__.'/../../../../../../../web'.self::getUploadDir();
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

        $this->path = $this->getFileName();
        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and then the target filename to move to
        $this->file->move(self::getUploadRootDir(), $this->path);

        // set the path property to the filename where you'ved saved the file
        

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
     * @return Image
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

    /**
     * Set path
     *
     * @param string $path
     * @return Image
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Image
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add elements
     *
     * @param IDCI\Bundle\GenealogyBundle\Entity\Element $elements
     * @return Image
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

    /**
     * Set file
     *
     * @param File $file
     * @return Image
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return File 
     */
    public function getFile()
    {
        return $this->file;
    }
}