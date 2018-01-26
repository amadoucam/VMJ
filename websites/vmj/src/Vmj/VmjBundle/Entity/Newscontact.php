<?php

namespace Vmj\VmjBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Newscontact
 *
 * @ORM\Table(name="newscontact")
 * @ORM\Entity(repositoryClass="Vmj\VmjBundle\Repository\NewscontactRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Newscontact
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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="inscrit", type="boolean", nullable=true, options={"default":1})
     */
    private $inscrit;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $modified;


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
     * Set emails
     *
     * @param string $emails
     *
     * @return Newscontact
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * Get emails
     *
     * @return string
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Newscontact
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
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return Newscontact
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
     * Set email
     *
     * @param string $email
     *
     * @return Newscontact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set inscrit
     *
     * @param boolean $inscrit
     *
     * @return Newscontact
     */
    public function setInscrit($inscrit)
    {
        $this->inscrit = $inscrit;

        return $this;
    }

    /**
     * Get inscrit
     *
     * @return boolean
     */
    public function getInscrit()
    {
        return $this->inscrit;
    }
}
