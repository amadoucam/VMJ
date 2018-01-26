<?php

namespace Vmj\VmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="Vmj\VmjBundle\Repository\CommandeRepository")
 */
class Commande
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
     * 
     * @var \Vmj\UserBundle\Entity\UserProfile Profil du client 
     * 
     * @ORM\ManyToOne(targetEntity="Vmj\UserBundle\Entity\UserProfile", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $customer;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=TRUE)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="motivation", type="text", nullable=TRUE)
     */
    private $motivation;
    
    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer")
     */
    private $statut;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="date", nullable=true)
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="date", nullable=true)
     */
    private $end;
    
    /**
     * 
     * @var \Vmj\VmjBundle\Entity\Immersion Profil du client 
     * 
     * @ORM\ManyToOne(targetEntity="Vmj\VmjBundle\Entity\Immersion", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $immersion;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;


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
     * Set price
     *
     * @param float $price
     *
     * @return Commande
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Commande
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Commande
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Commande
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set customer
     *
     * @param \Vmj\UserBundle\Entity\UserProfile $customer
     *
     * @return Commande
     */
    public function setCustomer(\Vmj\UserBundle\Entity\UserProfile $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Vmj\UserBundle\Entity\UserProfile
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set statut
     *
     * @param integer $statut
     *
     * @return Commande
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return integer
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Commande
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return Commande
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set immersion
     *
     * @param \Vmj\VmjBundle\Entity\Immersion $immersion
     *
     * @return Commande
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
     * Set motivation
     *
     * @param string $motivation
     *
     * @return Commande
     */
    public function setMotivation($motivation)
    {
        $this->motivation = $motivation;

        return $this;
    }

    /**
     * Get motivation
     *
     * @return string
     */
    public function getMotivation()
    {
        return $this->motivation;
    }
}
