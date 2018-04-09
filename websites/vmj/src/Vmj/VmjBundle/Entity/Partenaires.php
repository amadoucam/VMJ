<?php

namespace Vmj\VmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Partenaires
 *
 * @ORM\Table(name="partenaires")
 * @ORM\Entity(repositoryClass="Vmj\VmjBundle\Repository\PartenairesRepository")
 */
class Partenaires
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="logolien", type="string", length=255)
     */
     private $logolien;

     /**
     * @Assert\File(maxSize="2048k",
     *  mimeTypes = {"image/jpeg","image/jpg","image/png","image/bmp"},
     *  mimeTypesMessage = "Ce fichier doit �tre une image")
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="cat", type="string", length=20)
     */
    private $cat;

    public function __construct() {

    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getlogo() {
        return $this->logo;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setLogo(UploadedFile $logo = null) {
        $this->logo = $logo;
    }

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
     * @return Presse
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

    public function uploadLogo() {
        if (null === $this->logo) {
            return;
        }
        //name
        $name = $this->logo->getClientOriginalName();
        //$extension = substr(strrchr($name, '.'), 1);//exemple .jpg
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $name = trim($name);
        // $url = "imgPresentation-" . $this->id . "." . $extension;
        //move
        $this->logo->move($this->getUploadRootDir(), $name);
        //save
        $this->logolien = $name;
    }

    public function getUploadRootDir() {
        return __dir__ . '/../../../../web/theme/img/logo';
    }

   	/**
	 * Set logolien
	 *
	 * @param string $logolien
	 *
	 * @return Partenaires
	 */
    public function setLogolien($logolien)
    {
        $this->logolien = $logolien;

       return $this;
   }

   	/**
     * Get logolien
     *
     * @return string
  	 */
  	public function getLogolien()
  	{
  		return $this->logolien;
 	}

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Partenaires
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set cat
     *
     * @param string $cat
     *
     * @return Partenaires
     */
    public function setCat($cat)
    {
        $this->cat = $cat;

        return $this;
    }

    /**
     * Get cat
     *
     * @return string
     */
    public function getCat()
    {
        return $this->cat;
    }
}
