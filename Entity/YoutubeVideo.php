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
 * IDCI\Bundle\GenealogyBundle\Entity\YoutubeVideo
 *
 * @ORM\Table(name="video")
 * @ORM\Entity
 */
class YoutubeVideo
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
    private $link;
    
    /**
     * @ORM\ManyToMany(targetEntity="IDCI\Bundle\GenealogyBundle\Entity\Element", mappedBy="youtubeVideos")
     */
    private $elements;

    /**
     * YoutubeVideo to string
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
     * Set link
     *
     * @param string $link
     * @return YoutubeVideo
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Add elements
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Element $elements
     * @return YoutubeVideo
     */
    public function addElement(\IDCI\Bundle\GenealogyBundle\Entity\Element $elements)
    {
        $this->elements[] = $elements;
    
        return $this;
    }

    /**
     * Remove elements
     *
     * @param \IDCI\Bundle\GenealogyBundle\Entity\Element $elements
     */
    public function removeElement(\IDCI\Bundle\GenealogyBundle\Entity\Element $elements)
    {
        $this->elements->removeElement($elements);
    }

    /**
     * Get elements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getElements()
    {
        return $this->elements;
    }
}