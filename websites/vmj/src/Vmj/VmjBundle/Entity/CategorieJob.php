<?php

namespace Vmj\VmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CategorieJob
 *
 * @ORM\Table(name="categorie_job")
 * @ORM\Entity(repositoryClass="Vmj\VmjBundle\Repository\CategorieJobRepository")
 */
class CategorieJob
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=255)
     */
    private $slug;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $modified;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", options={"default":1})
     */
    private $actif;
    
    /**
     * 
     * @ORM\ManyToMany(targetEntity="Vmj\VmjBundle\Entity\Immersion", inversedBy="categories", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $immersions;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CategorieJob
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
     * Set slug
     *
     * @param string $slug
     *
     * @return CategorieJob
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return CategorieJob
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return CategorieJob
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }


    
    public function __toString() {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
       
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return CategorieJob
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Add immersion
     *
     * @param \Vmj\VmjBundle\Entity\Immersion $immersion
     *
     * @return CategorieJob
     */
    public function addImmersion(\Vmj\VmjBundle\Entity\Immersion $immersion)
    {
        $this->immersions[] = $immersion;

        return $this;
    }

    /**
     * Remove immersion
     *
     * @param \Vmj\VmjBundle\Entity\Immersion $immersion
     */
    public function removeImmersion(\Vmj\VmjBundle\Entity\Immersion $immersion)
    {
        $this->immersions->removeElement($immersion);
    }

    /**
     * Get immersions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImmersions()
    {
        return $this->immersions;
    }
}
