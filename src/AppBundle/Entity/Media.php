<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Imagick as Imagick;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MediaRepository")
 */
class Media
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
     * @ORM\Column(name="type", type="string", length=10)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="size_ko", type="decimal", precision=10, scale=0)
     */
    private $sizeKo;

    /**
     * @var string
     *
     * @ORM\Column(name="file_old_name", type="string", length=255)
     */
    private $fileOldName;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="folder", type="string", length=255)
     */
    private $folder;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added", type="datetime")
     */
    private $added;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event", inversedBy="medias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pdv_date", type="datetime")
     */
    private $pdvDate;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="camera", type="string", length=255)
     */
    private $camera;

    /**
     * @var string
     *
     * @ORM\Column(name="focal", type="string", length=255)
     */
    private $focal;

    /**
     * @var string
     *
     * @ORM\Column(name="focal_35", type="string", length=255)
     */
    private $focal35;

    /**
     * @var string
     *
     * @ORM\Column(name="iso", type="string", length=255)
     */
    private $iso;

    /**
     * @var string
     *
     * @ORM\Column(name="speed", type="string", length=255)
     */
    private $speed;

    /**
     * @var string
     *
     * @ORM\Column(name="aperture", type="string", length=255)
     */
    private $aperture;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=255)
     */
    private $duration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime")
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="video_set", type="string", length=255)
     */
    private $videoSet;

    /**
     * @var string
     *
     * @ORM\Column(name="gps_lat", type="string", length=255)
     */
    private $gpsLat;

    /**
     * @var string
     *
     * @ORM\Column(name="gps_lon", type="string", length=255)
     */
    private $gpsLon;

    /**
     * @var string
     *
     * @ORM\Column(name="infos", type="string", length=6400)
     */
    private $infos;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FacePlace", mappedBy="media", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $facePlaces;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MediaComment", mappedBy="media", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $comments;

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
        $this->facePlaces = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Media
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set sizeKo
     *
     * @param string $sizeKo
     *
     * @return Media
     */
    public function setSizeKo($sizeKo)
    {
        $this->sizeKo = $sizeKo;

        return $this;
    }

    /**
     * Get sizeKo
     *
     * @return string
     */
    public function getSizeKo()
    {
        return $this->sizeKo;
    }

    /**
     * Set fileOldName
     *
     * @param string $fileOldName
     *
     * @return Media
     */
    public function setFileOldName($fileOldName)
    {
        $this->fileOldName = $fileOldName;

        return $this;
    }

    /**
     * Get fileOldName
     *
     * @return string
     */
    public function getFileOldName()
    {
        return $this->fileOldName;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Media
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

    /**
     * Set folder
     *
     * @param string $folder
     *
     * @return Media
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set added
     *
     * @param \DateTime $added
     *
     * @return Media
     */
    public function setAdded($added)
    {
        $this->added = $added;

        return $this;
    }

    /**
     * Get added
     *
     * @return \DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * Set pdvDate
     *
     * @param \DateTime $pdvDate
     *
     * @return Media
     */
    public function setPdvDate($pdvDate)
    {
        $this->pdvDate = $pdvDate;

        return $this;
    }

    /**
     * Get pdvDate
     *
     * @return \DateTime
     */
    public function getPdvDate()
    {
        return $this->pdvDate;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Media
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set camera
     *
     * @param string $camera
     *
     * @return Media
     */
    public function setCamera($camera)
    {
        $this->camera = $camera;

        return $this;
    }

    /**
     * Get camera
     *
     * @return string
     */
    public function getCamera()
    {
        return $this->camera;
    }

    /**
     * Set focal
     *
     * @param string $focal
     *
     * @return Media
     */
    public function setFocal($focal)
    {
        $this->focal = $focal;

        return $this;
    }

    /**
     * Get focal
     *
     * @return string
     */
    public function getFocal()
    {
        return $this->focal;
    }

    /**
     * Set focal35
     *
     * @param string $focal35
     *
     * @return Media
     */
    public function setFocal35($focal35)
    {
        $this->focal35 = $focal35;

        return $this;
    }

    /**
     * Get focal35
     *
     * @return string
     */
    public function getFocal35()
    {
        return $this->focal35;
    }

    /**
     * Set iso
     *
     * @param string $iso
     *
     * @return Media
     */
    public function setIso($iso)
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * Get iso
     *
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Set speed
     *
     * @param string $speed
     *
     * @return Media
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return string
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set aperture
     *
     * @param string $aperture
     *
     * @return Media
     */
    public function setAperture($aperture)
    {
        $this->aperture = $aperture;

        return $this;
    }

    /**
     * Get aperture
     *
     * @return string
     */
    public function getAperture()
    {
        return $this->aperture;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return Media
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return Media
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set duration
     *
     * @param string $duration
     *
     * @return Media
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Media
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Media
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set videoSet
     *
     * @param string $videoSet
     *
     * @return Media
     */
    public function setVideoSet($videoSet)
    {
        $this->videoSet = $videoSet;

        return $this;
    }

    /**
     * Get videoSet
     *
     * @return string
     */
    public function getVideoSet()
    {
        return $this->videoSet;
    }

    /**
     * Set gpsLat
     *
     * @param string $gpsLat
     *
     * @return Media
     */
    public function setGpsLat($gpsLat)
    {
        $this->gpsLat = $gpsLat;

        return $this;
    }

    /**
     * Get gpsLat
     *
     * @return string
     */
    public function getGpsLat()
    {
        return $this->gpsLat;
    }

    /**
     * Set gpsLon
     *
     * @param string $gpsLon
     *
     * @return Media
     */
    public function setGpsLon($gpsLon)
    {
        $this->gpsLon = $gpsLon;

        return $this;
    }

    /**
     * Get gpsLon
     *
     * @return string
     */
    public function getGpsLon()
    {
        return $this->gpsLon;
    }

    /**
     * Set infos
     *
     * @param string $infos
     *
     * @return Media
     */
    public function setInfos($infos)
    {
        $this->infos = $infos;

        return $this;
    }

    /**
     * Get infos
     *
     * @return string
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * Set event
     *
     * @param \AppBundle\Entity\Event $event
     *
     * @return Media
     */
    public function setEvent(\AppBundle\Entity\Event $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \AppBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Add facePlace
     *
     * @param \AppBundle\Entity\FacePlace $facePlace
     *
     * @return Media
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
     * Add comment
     *
     * @param \AppBundle\Entity\MediaComment $comment
     *
     * @return Media
     */
    public function addComment(\AppBundle\Entity\MediaComment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\MediaComment $comment
     */
    public function removeComment(\AppBundle\Entity\MediaComment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    public function creatThumbnail($size, $basePath, $squared){

        $originalMadia = $basePath."/".$this->getFolder()."/PHOTOS/".$this->getName();

        $mediaPath = $basePath;
        $mediaPath .= "/imagesdisplay/".sprintf("%08d",$this->getEvent()->getId())."/".sprintf("%08d",$this->getId())."_".$size;
        if ($squared > 0) {
            $mediaPath .= "_sq";
            }
        $mediaPath .= ".jpg";

        $h = $this->getHeight();
        $w = $this->getWidth();

        // then calculate the resize perc based upon that dimension
        $p = ( $w < $h ) ? (100 / $w) * $size : (100 / $h) * $size;

        // define new width / height
        if (is_numeric($p)) {
            $nw = ceil($w / 100 * $p);
            $nh = ceil($h / 100 * $p);
            }

        $redim = new Imagick($originalMadia);

        if ($squared) {
            $redim->cropThumbnailImage( $size, $size );
            }
        else{
            $redim->resizeImage($nw,$nh,Imagick::FILTER_LANCZOS,1);
            }
        
        $redim->setImageCompression(Imagick::COMPRESSION_JPEG);

        // Set compression level (1 lowest quality, 100 highest quality)
        
        $comp = 85;
        if ($size < 200) {
            $comp = 60;
            }
        $redim->setImageCompressionQuality($comp);
        

        // Strip out unneeded meta data
        $redim->stripImage();


        $redim->writeImage($mediaPath);

        $redim->destroy();

        return $this;

        }
}
