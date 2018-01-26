<?php

namespace Vmj\VmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Immersion
 *
 * @ORM\Table(name="immersion")
 * @ORM\Entity(repositoryClass="Vmj\VmjBundle\Repository\ImmersionRepository")
 * @Gedmo\SoftDeleteable(fieldName="deleted")
 */
class Immersion {

    /**
     * @var string
     *
     * @ORM\Column(name="champAutre", type="text", nullable=true)
     */
    private $champAutre;
    /**
     * @var string
     *
     * @ORM\Column(name="hostFirstname", type="string", nullable=true, length=255)
     */
    private $hostFirstname;
    /**
     * @var string
     *
     * @ORM\Column(name="hostLastname", type="string", nullable=true, length=255)
     */
    private $hostLastname;
    /**
     * @var string
     *
     * @ORM\Column(name="hostNumber", type="string", nullable=true, length=255)
     */
    private $hostNumber;
    /**
     * @var string
     *
     * @ORM\Column(name="secondAddress", type="string", nullable=true, length=255)
     */
    private $secondAddress;
    /**
     * @var string
     *
     * @ORM\Column(name="secondCp", type="string", nullable=true, length=255)
     */
    private $secondCp;
    /**
     * @var string
     *
     * @ORM\Column(name="secondTown", type="string", nullable=true, length=255)
     */
    private $secondTown;
    /**
     * @var string
     *
     * @ORM\Column(name="association", type="string", nullable=true, length=255)
     */
    private $association;
    /**
     * @var string
     *
     * @ORM\Column(name="champHebergement", type="text", nullable=true)
     */
    private $champHebergement;
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
     * @var string
     * 
     * @ORM\Column(name="title", type="string", nullable=true)
     */
    private $title;
    
    /**
     * 
     * @Gedmo\Slug(fields={"title","secondCp","secondTown"})
     * @ORM\Column(length=255)
     */
    private $slug;
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="receiveHandicap", type="boolean", nullable=true)
     */
    private $receiveHandicap;
    /**
     * @var boolean
     *
     * @ORM\Column(name="actifAdmin", type="boolean", nullable=true, options={"default":0})
     */
    private $actifAdmin;
    /**
     * @var boolean
     *
     * @ORM\Column(name="actifPro", type="boolean", nullable=true, options={"default":1})
     */
    private $actifPro;
    /**
     * @var boolean
     *
     * @ORM\Column(name="lundi", type="boolean", nullable=true)
     */
    private $lundi;
    /**
     * @var boolean
     *
     * @ORM\Column(name="mardi", type="boolean", nullable=true)
     */
    private $mardi;
    /**
     * @var boolean
     *
     * @ORM\Column(name="mercredi", type="boolean", nullable=true)
     */
    private $mercredi;
    /**
     * @var boolean
     *
     * @ORM\Column(name="jeudi", type="boolean", nullable=true)
     */
    private $jeudi;
    /**
     * @var boolean
     *
     * @ORM\Column(name="vendredi", type="boolean", nullable=true)
     */
    private $vendredi;
    /**
     * @var boolean
     *
     * @ORM\Column(name="samedi", type="boolean", nullable=true)
     */
    private $samedi;
    /**
     * @var boolean
     *
     * @ORM\Column(name="dimanche", type="boolean", nullable=true)
     */
    private $dimanche;
    /**
     * @var boolean
     *
     * @ORM\Column(name="autisme", type="boolean", nullable=true)
     */
    private $autisme;
    /**
     * @var boolean
     *
     * @ORM\Column(name="moteur", type="boolean", nullable=true)
     */
    private $moteur;
    /**
     * @var boolean
     *
     * @ORM\Column(name="visuel", type="boolean", nullable=true)
     */
    private $visuel;
    /**
     * @var boolean
     *
     * @ORM\Column(name="auditif", type="boolean", nullable=true)
     */
    private $auditif;
    /**
     * @var boolean
     *
     * @ORM\Column(name="mental", type="boolean", nullable=true)
     */
    private $mental;
    /**
     * @var boolean
     *
     * @ORM\Column(name="autre", type="boolean", nullable=true)
     */
    private $autre;
    /**
     * @var boolean
     *
     * @ORM\Column(name="customerHost", type="boolean", nullable=true)
     */
    private $customerHost;
    /**
     * @var boolean
     *
     * @ORM\Column(name="sameAddress", type="boolean", nullable=true)
     */
    private $sameAddress;
    /**
     * @var boolean
     *
     * @ORM\Column(name="gainToAssociation", type="boolean", nullable=true)
     */
    private $gainToAssociation;
    /**
     * @var boolean
     *
     * @ORM\Column(name="hebergement", type="boolean", nullable=true)
     */
    private $hebergement;
    /**
     * 
     * @ORM\ManyToMany(targetEntity="Vmj\VmjBundle\Entity\CategorieJob", mappedBy="immersions", cascade={"persist"})
     */
    private $categories;

    /**
     * 
     * @var \Vmj\VmjBundle\Entity\UserProfile
     * 
     * @ORM\ManyToOne(targetEntity="Vmj\UserBundle\Entity\UserProfile", inversedBy="postes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $professionnel;

    /**
     * 
     * @var \Vmj\VmjBundle\Entity\Temoignages
     * 
     * @ORM\OneToMany(targetEntity="Vmj\VmjBundle\Entity\Temoignages", mappedBy="immersion", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $temoignages;

    /**
     * @var float
     *
     * @ORM\Column(name="weekprice", type="float", nullable=true)
     */
    private $weekprice;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="advert", type="text", nullable=true)
     */
    private $advert;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="skills", type="string", nullable=true)
     */
    private $skills;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="beginHour", type="string", nullable=true)
     */
    private $beginHour;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="endHour", type="string", nullable=true)
     */
    private $endHour;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $conditions;
    /**
     * @Assert\File(maxSize="2048k",
     *  mimeTypes = {"image/jpeg","image/jpg","image/png","image/bmp"},
     *  mimeTypesMessage = "Ce fichier doit �tre une image")
     */
    private $imgPresentation;
    /**
     * @Assert\File(maxSize="2048k",
     *  mimeTypes = {"image/jpeg","image/jpg","image/png","image/bmp"},
     *  mimeTypesMessage = "Ce fichier doit �tre une image")
     */
    private $banniere;
    /**
     * @var string
     *
     * 
     * @ORM\Column(name="lienImgPresentation", type="string", length=255, nullable=true)
     */
    private $lienImgPresentation;
    /**
     * @var string
     *
     * 
     * @ORM\Column(name="lienBanniere", type="string", length=255, nullable=true)
     */
    private $lienBanniere;
    /**
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;
    /**
     * 
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

    public function __construct() {
        
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getImgPresentation() {
        return $this->imgPresentation;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setImgPresentation(UploadedFile $imgPresentation = null) {
        $this->imgPresentation = $imgPresentation;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getBanniere() {
        return $this->banniere;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setBanniere(UploadedFile $banniere = null) {
        $this->banniere = $banniere;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Add temoignage
     *
     * @param \Vmj\VmjBundle\Entity\Temoignages $temoignage
     *
     * @return Immersion
     */
    public function addTemoignage(\Vmj\VmjBundle\Entity\Temoignages $temoignage) {
        $this->temoignages[] = $temoignage;

        return $this;
    }

    /**
     * Remove temoignage
     *
     * @param \Vmj\VmjBundle\Entity\Temoignages $temoignage
     */
    public function removeTemoignage(\Vmj\VmjBundle\Entity\Temoignages $temoignage) {
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

    public function __toString() {
        return '' . $this->title;
    }

    /**
     * Get weekprice
     *
     * @return float
     */
    public function getWeekprice() {
        return $this->weekprice;
    }

    /**
     * Set weekprice
     *
     * @param float $weekprice
     *
     * @return Immersion
     */
    public function setWeekprice($weekprice) {
        $this->weekprice = $weekprice;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Immersion
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get advert
     *
     * @return string
     */
    public function getAdvert() {
        return $this->advert;
    }

    /**
     * Set advert
     *
     * @param string $advert
     *
     * @return Immersion
     */
    public function setAdvert($advert) {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get skills
     *
     * @return string
     */
    public function getSkills() {
        return $this->skills;
    }

    /**
     * Set skills
     *
     * @param string $skills
     *
     * @return Immersion
     */
    public function setSkills($skills) {
        $this->skills = $skills;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return string
     */
    public function getConditions() {
        return $this->conditions;
    }

    /**
     * Set conditions
     *
     * @param string $conditions
     *
     * @return Immersion
     */
    public function setConditions($conditions) {
        $this->conditions = $conditions;

        return $this;
    }

    public function uploadImg() {
        if (null === $this->imgPresentation) {
            return;
        }
        //name
        $name = $this->imgPresentation->getClientOriginalName();
        //$extension = substr(strrchr($name, '.'), 1);//exemple .jpg
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $name = trim($name);
       // $url = "imgPresentation-" . $this->id . "." . $extension;
        //move
        $this->imgPresentation->move($this->getUploadRootDir(), $name);
        //save
        $this->lienImgPresentation = $name;
    }

    public function getUploadRootDir() {
        return __dir__ . '/../../../../web/uploads';
    }

    public function uploadBanniere() {
        if (null === $this->banniere) {
            return;
        }
        //name
        $name = $this->banniere->getClientOriginalName();
        //$extension = substr(strrchr($name, '.'), 1);//exemple .jpg
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $name = trim($name);
        //$url = "banniere-" . $this->slug . "." . $extension;
        //move
        $this->banniere->move($this->getUploadRootDir(), $name);
        //save
        $this->lienBanniere = $name;
    }

    /**
     * Get lienImgPresentation
     *
     * @return string
     */
    public function getLienImgPresentation() {
        return $this->lienImgPresentation;
    }

    /**
     * Set lienImgPresentation
     *
     * @param string $lienImgPresentation
     *
     * @return Immersion
     */
    public function setLienImgPresentation($lienImgPresentation) {
        $this->lienImgPresentation = $lienImgPresentation;

        return $this;
    }

    /**
     * Get lienBanniere
     *
     * @return string
     */
    public function getLienBanniere() {
        return $this->lienBanniere;
    }

    /**
     * Set lienBanniere
     *
     * @param string $lienBanniere
     *
     * @return Immersion
     */
    public function setLienBanniere($lienBanniere) {
        $this->lienBanniere = $lienBanniere;

        return $this;
    }

    /**
     * Get professionnel
     *
     * @return \Vmj\UserBundle\Entity\UserProfile
     */
    public function getProfessionnel() {
        return $this->professionnel;
    }

    /**
     * Set professionnel
     *
     * @param \Vmj\UserBundle\Entity\UserProfile $professionnel
     *
     * @return Immersion
     */
    public function setProfessionnel(\Vmj\UserBundle\Entity\UserProfile $professionnel = null) {
        $this->professionnel = $professionnel;

        return $this;
    }

    /**
     * Get beginHour
     *
     * @return string
     */
    public function getBeginHour() {
        return $this->beginHour;
    }

    /**
     * Set beginHour
     *
     * @param string $beginHour
     *
     * @return Immersion
     */
    public function setBeginHour($beginHour) {
        $this->beginHour = $beginHour;

        return $this;
    }

    /**
     * Get endHour
     *
     * @return string
     */
    public function getEndHour() {
        return $this->endHour;
    }

    /**
     * Set endHour
     *
     * @param string $endHour
     *
     * @return Immersion
     */
    public function setEndHour($endHour) {
        $this->endHour = $endHour;

        return $this;
    }

    /**
     * Get receiveHandicap
     *
     * @return boolean
     */
    public function getReceiveHandicap() {
        return $this->receiveHandicap;
    }

    /**
     * Set receiveHandicap
     *
     * @param boolean $receiveHandicap
     *
     * @return Immersion
     */
    public function setReceiveHandicap($receiveHandicap) {
        $this->receiveHandicap = $receiveHandicap;

        return $this;
    }

    /**
     * Get customerHost
     *
     * @return boolean
     */
    public function getCustomerHost() {
        return $this->customerHost;
    }

    /**
     * Set customerHost
     *
     * @param boolean $customerHost
     *
     * @return Immersion
     */
    public function setCustomerHost($customerHost) {
        $this->customerHost = $customerHost;

        return $this;
    }

    /**
     * Get hostFirstname
     *
     * @return string
     */
    public function getHostFirstname() {
        return $this->hostFirstname;
    }

    /**
     * Set hostFirstname
     *
     * @param string $hostFirstname
     *
     * @return Immersion
     */
    public function setHostFirstname($hostFirstname) {
        $this->hostFirstname = $hostFirstname;

        return $this;
    }

    /**
     * Get hostLastname
     *
     * @return string
     */
    public function getHostLastname() {
        return $this->hostLastname;
    }

    /**
     * Set hostLastname
     *
     * @param string $hostLastname
     *
     * @return Immersion
     */
    public function setHostLastname($hostLastname) {
        $this->hostLastname = $hostLastname;

        return $this;
    }

    /**
     * Get hostNumber
     *
     * @return string
     */
    public function getHostNumber() {
        return $this->hostNumber;
    }

    /**
     * Set hostNumber
     *
     * @param string $hostNumber
     *
     * @return Immersion
     */
    public function setHostNumber($hostNumber) {
        $this->hostNumber = $hostNumber;

        return $this;
    }

    /**
     * Get sameAddress
     *
     * @return boolean
     */
    public function getSameAddress() {
        return $this->sameAddress;
    }

    /**
     * Set sameAddress
     *
     * @param boolean $sameAddress
     *
     * @return Immersion
     */
    public function setSameAddress($sameAddress) {
        $this->sameAddress = $sameAddress;

        return $this;
    }

    /**
     * Get secondAddress
     *
     * @return string
     */
    public function getSecondAddress() {
        return $this->secondAddress;
    }

    /**
     * Set secondAddress
     *
     * @param string $secondAddress
     *
     * @return Immersion
     */
    public function setSecondAddress($secondAddress) {
        $this->secondAddress = $secondAddress;

        return $this;
    }

    /**
     * Get secondCp
     *
     * @return string
     */
    public function getSecondCp() {
        return $this->secondCp;
    }

    /**
     * Set secondCp
     *
     * @param string $secondCp
     *
     * @return Immersion
     */
    public function setSecondCp($secondCp) {
        $this->secondCp = $secondCp;

        return $this;
    }

    /**
     * Get secondTown
     *
     * @return string
     */
    public function getSecondTown() {
        return $this->secondTown;
    }

    /**
     * Set secondTown
     *
     * @param string $secondTown
     *
     * @return Immersion
     */
    public function setSecondTown($secondTown) {
        $this->secondTown = $secondTown;

        return $this;
    }

    /**
     * Get gainToAssociation
     *
     * @return boolean
     */
    public function getGainToAssociation() {
        return $this->gainToAssociation;
    }

    /**
     * Set gainToAssociation
     *
     * @param boolean $gainToAssociation
     *
     * @return Immersion
     */
    public function setGainToAssociation($gainToAssociation) {
        $this->gainToAssociation = $gainToAssociation;

        return $this;
    }

    /**
     * Get association
     *
     * @return string
     */
    public function getAssociation() {
        return $this->association;
    }

    /**
     * Set association
     *
     * @param string $association
     *
     * @return Immersion
     */
    public function setAssociation($association) {
        $this->association = $association;

        return $this;
    }

    /**
     * Get hebergement
     *
     * @return boolean
     */
    public function getHebergement() {
        return $this->hebergement;
    }

    /**
     * Set hebergement
     *
     * @param boolean $hebergement
     *
     * @return Immersion
     */
    public function setHebergement($hebergement) {
        $this->hebergement = $hebergement;

        return $this;
    }

    /**
     * Get champHebergement
     *
     * @return string
     */
    public function getChampHebergement() {
        return $this->champHebergement;
    }

    /**
     * Set champHebergement
     *
     * @param string $champHebergement
     *
     * @return Immersion
     */
    public function setChampHebergement($champHebergement) {
        $this->champHebergement = $champHebergement;

        return $this;
    }

    /**
     * Get lundi
     *
     * @return boolean
     */
    public function getLundi() {
        return $this->lundi;
    }

    /**
     * Set lundi
     *
     * @param boolean $lundi
     *
     * @return Immersion
     */
    public function setLundi($lundi) {
        $this->lundi = $lundi;

        return $this;
    }

    /**
     * Get mardi
     *
     * @return boolean
     */
    public function getMardi() {
        return $this->mardi;
    }

    /**
     * Set mardi
     *
     * @param boolean $mardi
     *
     * @return Immersion
     */
    public function setMardi($mardi) {
        $this->mardi = $mardi;

        return $this;
    }

    /**
     * Get mercredi
     *
     * @return boolean
     */
    public function getMercredi() {
        return $this->mercredi;
    }

    /**
     * Set mercredi
     *
     * @param boolean $mercredi
     *
     * @return Immersion
     */
    public function setMercredi($mercredi) {
        $this->mercredi = $mercredi;

        return $this;
    }

    /**
     * Get jeudi
     *
     * @return boolean
     */
    public function getJeudi() {
        return $this->jeudi;
    }

    /**
     * Set jeudi
     *
     * @param boolean $jeudi
     *
     * @return Immersion
     */
    public function setJeudi($jeudi) {
        $this->jeudi = $jeudi;

        return $this;
    }

    /**
     * Get vendredi
     *
     * @return boolean
     */
    public function getVendredi() {
        return $this->vendredi;
    }

    /**
     * Set vendredi
     *
     * @param boolean $vendredi
     *
     * @return Immersion
     */
    public function setVendredi($vendredi) {
        $this->vendredi = $vendredi;

        return $this;
    }

    /**
     * Get samedi
     *
     * @return boolean
     */
    public function getSamedi() {
        return $this->samedi;
    }

    /**
     * Set samedi
     *
     * @param boolean $samedi
     *
     * @return Immersion
     */
    public function setSamedi($samedi) {
        $this->samedi = $samedi;

        return $this;
    }

    /**
     * Get dimanche
     *
     * @return boolean
     */
    public function getDimanche() {
        return $this->dimanche;
    }

    /**
     * Set dimanche
     *
     * @param boolean $dimanche
     *
     * @return Immersion
     */
    public function setDimanche($dimanche) {
        $this->dimanche = $dimanche;

        return $this;
    }

    /**
     * Get autisme
     *
     * @return boolean
     */
    public function getAutisme() {
        return $this->autisme;
    }

    /**
     * Set autisme
     *
     * @param boolean $autisme
     *
     * @return Immersion
     */
    public function setAutisme($autisme) {
        $this->autisme = $autisme;

        return $this;
    }

    /**
     * Get moteur
     *
     * @return boolean
     */
    public function getMoteur() {
        return $this->moteur;
    }

    /**
     * Set moteur
     *
     * @param boolean $moteur
     *
     * @return Immersion
     */
    public function setMoteur($moteur) {
        $this->moteur = $moteur;

        return $this;
    }

    /**
     * Get visuel
     *
     * @return boolean
     */
    public function getVisuel() {
        return $this->visuel;
    }

    /**
     * Set visuel
     *
     * @param boolean $visuel
     *
     * @return Immersion
     */
    public function setVisuel($visuel) {
        $this->visuel = $visuel;

        return $this;
    }

    /**
     * Get auditif
     *
     * @return boolean
     */
    public function getAuditif() {
        return $this->auditif;
    }

    /**
     * Set auditif
     *
     * @param boolean $auditif
     *
     * @return Immersion
     */
    public function setAuditif($auditif) {
        $this->auditif = $auditif;

        return $this;
    }

    /**
     * Get mental
     *
     * @return boolean
     */
    public function getMental() {
        return $this->mental;
    }

    /**
     * Set mental
     *
     * @param boolean $mental
     *
     * @return Immersion
     */
    public function setMental($mental) {
        $this->mental = $mental;

        return $this;
    }

    /**
     * Get autre
     *
     * @return boolean
     */
    public function getAutre() {
        return $this->autre;
    }

    /**
     * Set autre
     *
     * @param boolean $autre
     *
     * @return Immersion
     */
    public function setAutre($autre) {
        $this->autre = $autre;

        return $this;
    }

    /**
     * Get champAutre
     *
     * @return string
     */
    public function getChampAutre() {
        return $this->champAutre;
    }

    /**
     * Set champAutre
     *
     * @param string $champAutre
     *
     * @return Immersion
     */
    public function setChampAutre($champAutre) {
        $this->champAutre = $champAutre;

        return $this;
    }

    /**
     * Get actifAdmin
     *
     * @return boolean
     */
    public function getActifAdmin() {
        return $this->actifAdmin;
    }

    /**
     * Set actifAdmin
     *
     * @param boolean $actifAdmin
     *
     * @return Immersion
     */
    public function setActifAdmin($actifAdmin) {
        $this->actifAdmin = $actifAdmin;

        return $this;
    }

    /**
     * Get actifPro
     *
     * @return boolean
     */
    public function getActifPro() {
        return $this->actifPro;
    }

    /**
     * Set actifPro
     *
     * @param boolean $actifPro
     *
     * @return Immersion
     */
    public function setActifPro($actifPro) {
        $this->actifPro = $actifPro;

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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Immersion
     */
    public function setCreated($created)
    {
        $this->created = $created;

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
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Immersion
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Add category
     *
     * @param \Vmj\VmjBundle\Entity\CategorieJob $category
     *
     * @return Immersion
     */
    public function addCategory(\Vmj\VmjBundle\Entity\CategorieJob $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Vmj\VmjBundle\Entity\CategorieJob $category
     */
    public function removeCategory(\Vmj\VmjBundle\Entity\CategorieJob $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategoriesNull()
    {
        $this->categories = null;
    }

    /**
     * Set deleted
     *
     * @param \DateTime $deleted
     *
     * @return Immersion
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

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Immersion
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
}
