<?php

namespace Vmj\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;
use Vmj\VmjBundle\Entity\Immersion;

/**
 * UserProfile
 *
 * @ORM\Table("user_profile")
 * @ORM\Entity(repositoryClass="Vmj\UserBundle\Repository\UserProfileRepository")
 * @Gedmo\SoftDeleteable(fieldName="deleted")
 */
class UserProfile {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", nullable=true, length=255)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", nullable=true, length=255)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="profession", type="string", nullable=true, length=255)
     */
    protected $profession;

    /**
     * @var string
     *
     * @ORM\Column(name="town", type="string", nullable=true, length=255)
     */
    protected $town;

    /**
     * @ORM\OneToOne(targetEntity="Vmj\VmjBundle\Entity\Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity= "Vmj\VmjBundle\Entity\Conversations", mappedBy="emetteur", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $conversations;

    /**
     * @ORM\OneToMany(targetEntity= "Vmj\VmjBundle\Entity\Temoignages", mappedBy="redacteur", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $temoignages;

    /**
     * @ORM\OneToMany(targetEntity= "Vmj\VmjBundle\Entity\Conversations", mappedBy="recepteur", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $discussioninvite;

    /**
     * @ORM\OneToMany(targetEntity= "Vmj\VmjBundle\Entity\Messages", mappedBy="expediteur", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $envoyes;

    /**
     * @ORM\OneToMany(targetEntity= "Vmj\VmjBundle\Entity\Messages", mappedBy="destinataire", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $recus;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", nullable = TRUE, length=255)
     */
    protected $language;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", nullable = TRUE, length=255)
     */
    protected $sexe;

    /*     * * Individual ** */

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="job", type="string", nullable = TRUE, length=255)
     */
    private $job;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="address", type="string", nullable = TRUE, length=255)
     */
    private $address;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="address_more", type="string", nullable = TRUE, length=255)
     */
    private $address_more;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="region", type="string", nullable = TRUE, length=255)
     */
    private $region;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="postalcode", type="string", nullable = TRUE, length=5)
     */
    private $postalcode;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="phonenumber", type="string", nullable = TRUE, length=10)
     */
    private $phonenumber;

    /**
     *
     * @var boolean
     * 
     * @ORM\Column(name="newsletter", type="boolean", nullable = TRUE, length=255)
     */
    private $newsletter;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="email", type="string", nullable = TRUE, length=255)
     */
    private $email;

    /**
     *
     * @var boolean
     * 
     * @ORM\Column(name="contact_partner", type="boolean", nullable = TRUE, length=255)
     */
    private $contact_partner;

    /**
     * @ORM\OneToMany(targetEntity="Vmj\VmjBundle\Entity\Immersion", mappedBy="professionnel", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $postes;

    /**
     * @var integer
     * 
     * @ORM\Column(name="type", type="integer", nullable=false, options={"default" : 1})
     */
    private $type;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="business_name", type="string", nullable = TRUE, length=255)
     */
    private $businessName;

    /**
     *
     * @var siret
     *
     * @ORM\Column(name="siret", type="string", nullable = TRUE, length=255)
     */
    private $siret;

    /**
     *
     * @var integer
     *
     * @ORM\Column(name="type_tva", type="integer", nullable = TRUE, length=1)
     */
    private $type_tva;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="insurance_number", type="string", nullable = TRUE, length=255)
     */
    private $insuranceNumber;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="insurance_name", type="string", nullable = TRUE, length=255)
     */
    private $insuranceName;

    /**
     *
     * @var text
     *
     * @ORM\Column(name="business_description", type="text", nullable = TRUE)
     */
    private $businessDescription;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="website", type="string", nullable = TRUE, length=255)
     */
    private $website;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="facebook_link", type="string", nullable = TRUE, length=255)
     */
    private $facebookLink;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="linkedin_link", type="string", nullable = TRUE, length=255)
     */
    private $linkedinLink;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="rib", type="string", nullable = TRUE, length=255)
     */
    private $rib;

    /**
     * @Assert\File(maxSize="2048k",
     *  mimeTypes = {"image/jpeg","image/jpg","image/png","image/bmp"},
     *  mimeTypesMessage = "Ce fichier doit être une image")
     */
    private $photo;
    
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
     * @var \DateTime $deleted
     *
     * @ORM\Column(name="deleted", type="datetime", nullable=true)
     */
    private $deleted;

    /**
     * @var string
     *
     * 
     * @ORM\Column(name="lienPhoto", type="string", length=255, nullable=true)
     */
    private $lienPhoto;

    public function uploadPhoto() {
        if (null === $this->photo) {
            return;
        }
        //name
        $name = $this->photo->getClientOriginalName();
        //$extension = substr(strrchr($name, '.'), 1);//exemple .jpg
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $url = "photo" . $this->firstname . "-" . $this->id . "." . $extension;
        //move
        $this->photo->move($this->getUploadRootDir(), $url);
        //save
        $this->lienPhoto = $url;
    }

    public function getUploadRootDir() {
        return __dir__ . '/../../../../web/uploads';
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct() {
        
    }

    public function __toString() {
        return $this->firstname . " " . $this->lastname;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return UserProfile
     */
    public function setBirthday($birthday) {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return UserProfile
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return UserProfile
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set profession
     *
     * @param string $profession
     *
     * @return UserProfile
     */
    public function setProfession($profession) {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession() {
        return $this->profession;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return UserProfile
     */
    public function setTown($town) {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown() {
        return $this->town;
    }

    /**
     * Set language
     *
     * @param string $language
     *
     * @return UserProfile
     */
    public function setLanguage($language) {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return UserProfile
     */
    public function setSexe($sexe) {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe() {
        return $this->sexe;
    }

    /**
     * Set job
     *
     * @param string $job
     *
     * @return UserProfile
     */
    public function setJob($job) {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob() {
        return $this->job;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return UserProfile
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set addressMore
     *
     * @param string $addressMore
     *
     * @return UserProfile
     */
    public function setAddressMore($addressMore) {
        $this->address_more = $addressMore;

        return $this;
    }

    /**
     * Get addressMore
     *
     * @return string
     */
    public function getAddressMore() {
        return $this->address_more;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return UserProfile
     */
    public function setRegion($region) {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion() {
        return $this->region;
    }

    /**
     * Set postalcode
     *
     * @param string $postalcode
     *
     * @return UserProfile
     */
    public function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;

        return $this;
    }

    /**
     * Get postalcode
     *
     * @return string
     */
    public function getPostalcode() {
        return $this->postalcode;
    }

    /**
     * Set phonenumber
     *
     * @param string $phonenumber
     *
     * @return UserProfile
     */
    public function setPhonenumber($phonenumber) {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * Get phonenumber
     *
     * @return string
     */
    public function getPhonenumber() {
        return $this->phonenumber;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     *
     * @return UserProfile
     */
    public function setNewsletter($newsletter) {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean
     */
    public function getNewsletter() {
        return $this->newsletter;
    }

    /**
     * Set contactPartner
     *
     * @param boolean $contactPartner
     *
     * @return UserProfile
     */
    public function setContactPartner($contactPartner) {
        $this->contact_partner = $contactPartner;

        return $this;
    }

    /**
     * Get contactPartner
     *
     * @return boolean
     */
    public function getContactPartner() {
        return $this->contact_partner;
    }

    /**
     * Set avatar
     *
     * @param \Vmj\VmjBundle\Entity\Media $avatar
     *
     * @return UserProfile
     */
    public function setAvatar(\Vmj\VmjBundle\Entity\Media $avatar) {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return \Vmj\VmjBundle\Entity\Media
     */
    public function getAvatar() {
        return $this->avatar;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setPhoto(UploadedFile $photo = null) {
        $this->photo = $photo;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getPhoto() {
        return $this->photo;
    }
    /**
     * Add conversation
     *
     * @param \Vmj\VmjBundle\Entity\Conversations $conversation
     *
     * @return UserProfile
     */
    public function addConversation(\Vmj\VmjBundle\Entity\Conversations $conversation) {
        $this->conversations[] = $conversation;

        return $this;
    }

    /**
     * Remove conversation
     *
     * @param \Vmj\VmjBundle\Entity\Conversations $conversation
     */
    public function removeConversation(\Vmj\VmjBundle\Entity\Conversations $conversation) {
        $this->conversations->removeElement($conversation);
    }

    /**
     * Get conversations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConversations() {
        return $this->conversations;
    }

    /**
     * Add discussioninvite
     *
     * @param \Vmj\VmjBundle\Entity\Conversations $discussioninvite
     *
     * @return UserProfile
     */
    public function addDiscussioninvite(\Vmj\VmjBundle\Entity\Conversations $discussioninvite) {
        $this->discussioninvite[] = $discussioninvite;

        return $this;
    }

    /**
     * Remove discussioninvite
     *
     * @param \Vmj\VmjBundle\Entity\Conversations $discussioninvite
     */
    public function removeDiscussioninvite(\Vmj\VmjBundle\Entity\Conversations $discussioninvite) {
        $this->discussioninvite->removeElement($discussioninvite);
    }

    /**
     * Get discussioninvite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiscussioninvite() {
        return $this->discussioninvite;
    }

    /**
     * Add envoye
     *
     * @param \Vmj\VmjBundle\Entity\Messages $envoye
     *
     * @return UserProfile
     */
    public function addEnvoye(\Vmj\VmjBundle\Entity\Messages $envoye) {
        $this->envoyes[] = $envoye;

        return $this;
    }

    /**
     * Remove envoye
     *
     * @param \Vmj\VmjBundle\Entity\Messages $envoye
     */
    public function removeEnvoye(\Vmj\VmjBundle\Entity\Messages $envoye) {
        $this->envoyes->removeElement($envoye);
    }

    /**
     * Get envoyes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnvoyes() {
        return $this->envoyes;
    }

    /**
     * Add recus
     *
     * @param \Vmj\VmjBundle\Entity\Conversations $recus
     *
     * @return UserProfile
     */
    public function addRecus(\Vmj\VmjBundle\Entity\Conversations $recus) {
        $this->recus[] = $recus;

        return $this;
    }

    /**
     * Remove recus
     *
     * @param \Vmj\VmjBundle\Entity\Conversations $recus
     */
    public function removeRecus(\Vmj\VmjBundle\Entity\Conversations $recus) {
        $this->recus->removeElement($recus);
    }

    /**
     * Get recus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecus() {
        return $this->recus;
    }

    /**
     * Add poste
     *
     * @param Immersion $poste
     *
     * @return UserProfile
     */
    public function addPoste(Immersion $poste) {
        $this->postes[] = $poste;

        return $this;
    }

    /**
     * Remove poste
     *
     * @param Immersion $poste
     */
    public function removePoste(Immersion $poste) {
        $this->postes->removeElement($poste);
    }

    /**
     * Get postes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPostes() {
        return $this->postes;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return UserProfile
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Add temoignage
     *
     * @param \Vmj\VmjBundle\Entity\Conversations $temoignage
     *
     * @return UserProfile
     */
    public function addTemoignage(\Vmj\VmjBundle\Entity\Conversations $temoignage) {
        $this->temoignages[] = $temoignage;

        return $this;
    }

    /**
     * Remove temoignage
     *
     * @param \Vmj\VmjBundle\Entity\Conversations $temoignage
     */
    public function removeTemoignage(\Vmj\VmjBundle\Entity\Conversations $temoignage) {
        $this->temoignages->removeElement($temoignage);
    }

    /**
     * Get temoignages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemoignages() {
        return $this->temoignages;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return UserProfile
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set businessName
     *
     * @param string $businessName
     *
     * @return UserProfile
     */
    public function setBusinessName($businessName) {
        $this->businessName = $businessName;

        return $this;
    }

    /**
     * Get businessName
     *
     * @return string
     */
    public function getBusinessName() {
        return $this->businessName;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return UserProfile
     */
    public function setSiret($siret) {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret() {
        return $this->siret;
    }

    /**
     * Set typeTva
     *
     * @param integer $typeTva
     *
     * @return UserProfile
     */
    public function setTypeTva($typeTva) {
        $this->type_tva = $typeTva;

        return $this;
    }

    /**
     * Get typeTva
     *
     * @return integer
     */
    public function getTypeTva() {
        return $this->type_tva;
    }

    /**
     * Set insuranceNumber
     *
     * @param string $insuranceNumber
     *
     * @return UserProfile
     */
    public function setInsuranceNumber($insuranceNumber) {
        $this->insuranceNumber = $insuranceNumber;

        return $this;
    }

    /**
     * Get insuranceNumber
     *
     * @return string
     */
    public function getInsuranceNumber() {
        return $this->insuranceNumber;
    }

    /**
     * Set insuranceName
     *
     * @param string $insuranceName
     *
     * @return UserProfile
     */
    public function setInsuranceName($insuranceName) {
        $this->insuranceName = $insuranceName;

        return $this;
    }

    /**
     * Get insuranceName
     *
     * @return string
     */
    public function getInsuranceName() {
        return $this->insuranceName;
    }

    /**
     * Set businessDescription
     *
     * @param string $businessDescription
     *
     * @return UserProfile
     */
    public function setBusinessDescription($businessDescription) {
        $this->businessDescription = $businessDescription;

        return $this;
    }

    /**
     * Get businessDescription
     *
     * @return string
     */
    public function getBusinessDescription() {
        return $this->businessDescription;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return UserProfile
     */
    public function setWebsite($website) {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite() {
        return $this->website;
    }

    /**
     * Set facebookLink
     *
     * @param string $facebookLink
     *
     * @return UserProfile
     */
    public function setFacebookLink($facebookLink) {
        $this->facebookLink = $facebookLink;

        return $this;
    }

    /**
     * Get facebookLink
     *
     * @return string
     */
    public function getFacebookLink() {
        return $this->facebookLink;
    }

    /**
     * Set linkedinLink
     *
     * @param string $linkedinLink
     *
     * @return UserProfile
     */
    public function setLinkedinLink($linkedinLink) {
        $this->linkedinLink = $linkedinLink;

        return $this;
    }

    /**
     * Get linkedinLink
     *
     * @return string
     */
    public function getLinkedinLink() {
        return $this->linkedinLink;
    }

    /**
     * Set rib
     *
     * @param string $rib
     *
     * @return UserProfile
     */
    public function setRib($rib) {
        $this->rib = $rib;

        return $this;
    }

    /**
     * Get rib
     *
     * @return string
     */
    public function getRib() {
        return $this->rib;
    }


    /**
     * Set lienPhoto
     *
     * @param string $lienPhoto
     *
     * @return UserProfile
     */
    public function setLienPhoto($lienPhoto)
    {
        $this->lienPhoto = $lienPhoto;

        return $this;
    }

    /**
     * Get lienPhoto
     *
     * @return string
     */
    public function getLienPhoto()
    {
        return $this->lienPhoto;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return UserProfile
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
     * @return UserProfile
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
     * Set deleted
     *
     * @param \DateTime $deleted
     *
     * @return UserProfile
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
