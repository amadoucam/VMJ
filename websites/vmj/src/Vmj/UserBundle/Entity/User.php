<?php

namespace Vmj\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Vmj\UserBundle\Entity\UserProfile;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Vmj\UserBundle\Repository\UserRepository")
 * @Gedmo\SoftDeleteable(fieldName="deleted")
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser 
{
    private $roles_content = array(
        1 => 'ROLE_USER',
        2 => 'ROLE_PRO',
        3 => 'ROLE_ADMIN'
    );

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function initialisation()
    {
        if ($this->getUserProfile() !== null){
            $profile = $this->getUserProfile();
        }else{
            
            $profile = new UserProfile();
            $profile->setType(2);
            
        }
        $this->setUserProfile($profile);
    }

    /**
     * @ORM\PrePersist
     */
    public function update(){
        $this->roles = array($this->roles_content[$this->user_profile->getType()]);
        $this->user_profile->setEmail($this->email);
    }
    
    /**
     * @ORM\OneToOne(targetEntity= "Vmj\UserBundle\Entity\UserProfile", cascade={"persist", "remove"})
     */
    private $user_profile;
        
    /**
     * @var string
     *
     * @ORM\Column(name="twitter_id", type="string", nullable=true)
     */
    protected $twitter_id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="linkedin_id", type="string", nullable=true)
     */
    protected $linkedin_id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="facebookId", type="string", nullable=true, length=255)
     */
    protected $facebookId;

    /**
     * @var \DateTime $deleted
     *
     * @ORM\Column(name="deleted", type="datetime", nullable=true)
     */
    private $deleted;

    public function serialize()
    {
        return serialize(array($this->facebookId, parent::serialize()));
    }

    public function unserialize($data)
    {
        list($this->facebookId, $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }
    
    /**
     * @param string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        $this->setUsername($facebookId);
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param Array
     */
    
    public function setFBData($fbdata)
    {
        
        $profile = null;
        $test = "";
        if ($this->getUserProfile() !== null){
            $profile = $this->getUserProfile();
        }else{
            
            
            $profile = new UserProfile();
        }
        
        
        
        if (isset($fbdata['id'])) {
          /*  var_dump($test);*/
            //var_dump($fbdata);
        //die();
            $this->setFacebookId($fbdata['id']);
            $this->addRole('ROLE_FACEBOOK');
            
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstname($fbdata['first_name']);
            $profile->setFirstname($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setLastname($fbdata['last_name']);
            $profile->setLastname($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setEmail($fbdata['email']);
        }
        if (isset($fbdata['profile_picture'])) {
            $this->setAvatar($fbdata['profile_picture']);
        }
        if (isset($fbdata['gender'])) {
            $profile->setSexe($fbdata['gender']);
        }
        if (isset($fbdata['birthday'])) {
            $birth = new \DateTime($fbdata['birthday']);
            /*var_dump($birth);
            die();*/
            $profile->setBirthday($birth);
        }
        
        if (isset($fbdata['location']['name'])) {
            $this->setTown($fbdata['location']['name']);
        }
        
        $this->setUserProfile($profile);
    }
    
    public function __construct()
    {
        parent::__construct();
        $this->initialisation();
        // your own logic
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
     * Set userProfile
     *
     * @param \Vmj\UserBundle\Entity\UserProfile $userProfile
     *
     * @return User
     */
    public function setUserProfile(\Vmj\UserBundle\Entity\UserProfile $userProfile = null)
    {
        $this->user_profile = $userProfile;

        return $this;
    }

    /**
     * Get userProfile
     *
     * @return \Vmj\UserBundle\Entity\UserProfile
     */
    public function getUserProfile()
    {
        return $this->user_profile;
    }

    /**
     * Set twitterId
     *
     * @param string $twitterId
     *
     * @return User
     */
    public function setTwitterId($twitterId)
    {
        $this->twitter_id = $twitterId;

        return $this;
    }

    /**
     * Get twitterId
     *
     * @return string
     */
    public function getTwitterId()
    {
        return $this->twitter_id;
    }

    /**
     * Set linkedinId
     *
     * @param string $linkedinId
     *
     * @return User
     */
    public function setLinkedinId($linkedinId)
    {
        $this->linkedin_id = $linkedinId;

        return $this;
    }

    /**
     * Get linkedinId
     *
     * @return string
     */
    public function getLinkedinId()
    {
        return $this->linkedin_id;
    }

    /**
     * Set deleted
     *
     * @param \DateTime $deleted
     *
     * @return User
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return \DateTime
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}
