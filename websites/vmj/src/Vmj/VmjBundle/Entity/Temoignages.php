<?php

namespace Vmj\VmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Temoignages
 *
 * @ORM\Table(name="temoignages")
 * @ORM\Entity(repositoryClass="Vmj\VmjBundle\Repository\TemoignagesRepository")
 */
class Temoignages
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
     * @ORM\Column(name="temoignage", type="text")
     */
    private $temoignage;
    
    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float")
     */
    private $note;
    
    /**
     * 
     * @var \Vmj\VmjBundle\Entity\Temoignages 
     * 
     * @ORM\ManyToOne(targetEntity="Vmj\VmjBundle\Entity\Immersion", inversedBy="temoignages", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $immersion;
    

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var bool
     *
     * @ORM\Column(name="valide", type="boolean", nullable=true, options={"default":0})
     */
    private $valide;

    /**
     * 
     * @var \Vmj\VmjBundle\Entity\UserProfile
     * 
     * @ORM\ManyToOne(targetEntity="Vmj\UserBundle\Entity\UserProfile", inversedBy="temoignages", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $redacteur;
    
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
     * Set temoignage
     *
     * @param string $temoignage
     *
     * @return Temoignages
     */
    public function setTemoignage($temoignage)
    {
        $this->temoignage = $temoignage;

        return $this;
    }

    /**
     * Get temoignage
     *
     * @return string
     */
    public function getTemoignage()
    {
        return $this->temoignage;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Temoignages
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

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Temoignages
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     *
     * @return Temoignages
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return bool
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Temoignages
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set immersion
     *
     * @param \Vmj\VmjBundle\Entity\Immersion $immersion
     *
     * @return Temoignages
     */
    public function setImmersion(\Vmj\VmjBundle\Entity\Immersion $immersion = null)
    {
        $this->immersion = $immersion;

        return $this;
    }

    /**
     * Get immersion
     *
     * @return \Vmj\VmjBundle\Entity\Immersion
     */
    public function getImmersion()
    {
        return $this->immersion;
    }

    /**
     * Set redacteur
     *
     * @param \Vmj\UserBundle\Entity\UserProfile $redacteur
     *
     * @return Temoignages
     */
    public function setRedacteur(\Vmj\UserBundle\Entity\UserProfile $redacteur = null)
    {
        $this->redacteur = $redacteur;

        return $this;
    }

    /**
     * Get redacteur
     *
     * @return \Vmj\UserBundle\Entity\UserProfile
     */
    public function getRedacteur()
    {
        return $this->redacteur;
    }
}
