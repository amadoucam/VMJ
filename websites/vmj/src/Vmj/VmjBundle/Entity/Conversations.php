<?php

namespace Vmj\VmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Conversations
 *
 * @ORM\Table(name="conversations")
 * @ORM\Entity(repositoryClass="Vmj\VmjBundle\Repository\ConversationsRepository")
 */
class Conversations
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
     * @ORM\OneToMany(targetEntity= "Vmj\VmjBundle\Entity\Messages", mappedBy="conversation", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $messages;
    
    /**
     * @ORM\ManyToOne(targetEntity= "Vmj\UserBundle\Entity\UserProfile", inversedBy="conversations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $emetteur;
    
    /**
     * @ORM\ManyToOne(targetEntity= "Vmj\UserBundle\Entity\UserProfile", inversedBy="discussioninvite", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $recepteur;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="foradmin", type="boolean", options={"default":0})
     */
    private $foradmin;
    
    /**
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;
    
    /**
     * 
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;
    
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
     * Constructor
     */
    public function __construct()
    {
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Conversations
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
     * @return Conversations
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
     * Add message
     *
     * @param \Vmj\VmjBundle\Entity\Messages $message
     *
     * @return Conversations
     */
    public function addMessage(\Vmj\VmjBundle\Entity\Messages $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \Vmj\VmjBundle\Entity\Messages $message
     */
    public function removeMessage(\Vmj\VmjBundle\Entity\Messages $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set emetteur
     *
     * @param \Vmj\UserBundle\Entity\UserProfile $emetteur
     *
     * @return Conversations
     */
    public function setEmetteur(\Vmj\UserBundle\Entity\UserProfile $emetteur)
    {
        $this->emetteur = $emetteur;

        return $this;
    }

    /**
     * Get emetteur
     *
     * @return \Vmj\UserBundle\Entity\UserProfile
     */
    public function getEmetteur()
    {
        return $this->emetteur;
    }

    /**
     * Set recepteur
     *
     * @param \Vmj\UserBundle\Entity\UserProfile $recepteur
     *
     * @return Conversations
     */
    public function setRecepteur(\Vmj\UserBundle\Entity\UserProfile $recepteur)
    {
        $this->recepteur = $recepteur;

        return $this;
    }

    /**
     * Get recepteur
     *
     * @return \Vmj\UserBundle\Entity\UserProfile
     */
    public function getRecepteur()
    {
        return $this->recepteur;
    }

    /**
     * Set foradmin
     *
     * @param boolean $foradmin
     *
     * @return Conversations
     */
    public function setForadmin($foradmin)
    {
        $this->foradmin = $foradmin;

        return $this;
    }

    /**
     * Get foradmin
     *
     * @return boolean
     */
    public function getForadmin()
    {
        return $this->foradmin;
    }
}
