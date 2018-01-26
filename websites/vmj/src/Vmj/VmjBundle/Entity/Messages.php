<?php

namespace Vmj\VmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Messages
 *
 * @ORM\Table(name="messages")
 * @ORM\Entity(repositoryClass="Vmj\VmjBundle\Repository\MessagesRepository")
 */
class Messages
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
     * @ORM\Column(name="objet", type="string", length=125)
     */
    private $objet;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;
    
    /**
     * @ORM\ManyToOne(targetEntity= "Vmj\VmjBundle\Entity\Conversations", inversedBy="messages", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $conversation;
    
    /**
     * @ORM\ManyToOne(targetEntity= "Vmj\UserBundle\Entity\UserProfile", inversedBy="envoyes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $expediteur;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="foradmin", type="boolean", options={"default":0})
     */
    private $foradmin;
    
    /**
     * @ORM\ManyToOne(targetEntity= "Vmj\UserBundle\Entity\UserProfile", inversedBy="recus", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $destinataire;

    /**
     * @var bool
     *
     * @ORM\Column(name="lu", type="boolean", nullable=true)
     */
    private $lu;
    
    
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
     * Set message
     *
     * @param string $message
     *
     * @return Messages
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Messages
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
     * @return Messages
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
     * Set conversation
     *
     * @param \Vmj\VmjBundle\Entity\Conversations $conversation
     *
     * @return Messages
     */
    public function setConversation(\Vmj\VmjBundle\Entity\Conversations $conversation)
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * Get conversation
     *
     * @return \Vmj\VmjBundle\Entity\Conversations
     */
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * Set expediteur
     *
     * @param \Vmj\UserBundle\Entity\UserProfile $expediteur
     *
     * @return Messages
     */
    public function setExpediteur(\Vmj\UserBundle\Entity\UserProfile $expediteur)
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    /**
     * Get expediteur
     *
     * @return \Vmj\UserBundle\Entity\UserProfile
     */
    public function getExpediteur()
    {
        return $this->expediteur;
    }



    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return Messages
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set lu
     *
     * @param boolean $lu
     *
     * @return Messages
     */
    public function setLu($lu)
    {
        $this->lu = $lu;

        return $this;
    }

    /**
     * Get lu
     *
     * @return boolean
     */
    public function getLu()
    {
        return $this->lu;
    }

    /**
     * Set destinataire
     *
     * @param \Vmj\UserBundle\Entity\UserProfile $destinataire
     *
     * @return Messages
     */
    public function setDestinataire(\Vmj\UserBundle\Entity\UserProfile $destinataire = null)
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    /**
     * Get destinataire
     *
     * @return \Vmj\UserBundle\Entity\UserProfile
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }

    /**
     * Set foradmin
     *
     * @param boolean $foradmin
     *
     * @return Messages
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
