<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Face
 *
 * @ORM\Table(name="face")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FaceRepository")
 */
class Face
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="face")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    private $fullname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="datetime", nullable=true)
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="portrait_file_name", type="string", length=255, nullable=true)
     */
    private $portraitFileName;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FacePlace", mappedBy="face", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $facePlaces;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->facePlaces = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * To String
     */
    public function __toString() {
        return $this->getFullname();
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Face
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Face
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    // get Fullname
    public function getFullname()
    {
        return $this->firstname.' '.$this->lastname;
    }


    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return Face
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set portraitFileName
     *
     * @param string $portraitFileName
     *
     * @return Face
     */
    public function setPortraitFileName($portraitFileName)
    {
        $this->portraitFileName = $portraitFileName;

        return $this;
    }

    /**
     * Get portraitFileName
     *
     * @return string
     */
    public function getPortraitFileName()
    {
        return $this->portraitFileName;
    }

    /**
     * Add facePlace
     *
     * @param \AppBundle\Entity\FacePlace $facePlace
     *
     * @return Face
     */
    public function addFacePlace(\AppBundle\Entity\FacePlace $facePlace)
    {
        $this->facePlaces[] = $facePlace;

        return $this;
    }

    /**
     * Remove facePlace
     *
     * @param \AppBundle\Entity\FacePlace $facePlace
     */
    public function removeFacePlace(\AppBundle\Entity\FacePlace $facePlace)
    {
        $this->facePlaces->removeElement($facePlace);
    }

    /**
     * Get facePlaces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacePlaces()
    {
        return $this->facePlaces;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Face
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
