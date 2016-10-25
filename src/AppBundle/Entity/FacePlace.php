<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FacePlace
 *
 * @ORM\Table(name="face_place")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FacePlaceRepository")
 */
class FacePlace
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
     * @ORM\Column(name="coord_x", type="string", length=128)
     */
    private $coordX;

    /**
     * @var string
     *
     * @ORM\Column(name="coord_y", type="string", length=128)
     */
    private $coordY;

    /**
     * @var int
     *
     * @ORM\Column(name="dimension", type="integer")
     */
    private $dimension;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Face", inversedBy="facePlaces", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $face;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Photo", inversedBy="facePlaces", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $photo;

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
     * Set coordX
     *
     * @param string $coordX
     *
     * @return FacePlace
     */
    public function setCoordX($coordX)
    {
        $this->coordX = $coordX;

        return $this;
    }

    /**
     * Get coordX
     *
     * @return string
     */
    public function getCoordX()
    {
        return $this->coordX;
    }

    /**
     * Set coordY
     *
     * @param string $coordY
     *
     * @return FacePlace
     */
    public function setCoordY($coordY)
    {
        $this->coordY = $coordY;

        return $this;
    }

    /**
     * Get coordY
     *
     * @return string
     */
    public function getCoordY()
    {
        return $this->coordY;
    }

    /**
     * Set dimension
     *
     * @param integer $dimension
     *
     * @return FacePlace
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;

        return $this;
    }

    /**
     * Get dimension
     *
     * @return integer
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * Set face
     *
     * @param \AppBundle\Entity\Face $face
     *
     * @return FacePlace
     */
    public function setFace(\AppBundle\Entity\Face $face)
    {
        $this->face = $face;

        return $this;
    }

    /**
     * Get face
     *
     * @return \AppBundle\Entity\Face
     */
    public function getFace()
    {
        return $this->face;
    }

    /**
     * Set photo
     *
     * @param \AppBundle\Entity\Photo $photo
     *
     * @return FacePlace
     */
    public function setPhoto(\AppBundle\Entity\Photo $photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \AppBundle\Entity\Photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
