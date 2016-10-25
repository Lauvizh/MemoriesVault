<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VideoRepository")
 */
class Video
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
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="add_date", type="datetime")
     */
    private $addDate;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event", inversedBy="videos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer", nullable=true)
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer", nullable=true)
     */
    private $width;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=255, nullable=true)
     */
    private $duration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="video_poster", type="string", length=255, nullable=true)
     */
    private $videoPoster;

    /**
     * @var string
     *
     * @ORM\Column(name="gps_lat", type="string", length=255, nullable=true)
     */
    private $gpsLat;

    /**
     * @var string
     *
     * @ORM\Column(name="gps_lon", type="string", length=255, nullable=true)
     */
    private $gpsLon;

    /**
     * @var string
     *
     * @ORM\Column(name="gps_rad", type="string", length=255, nullable=true)
     */
    private $gpsRadius;

    /**
     * @var string
     *
     * @ORM\Column(name="infos", type="string", length=6400, nullable=true)
     */
    private $infos;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CommentVideo", mappedBy="video", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\VideoFile", mappedBy="video", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $files;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->isActive = false;
        $this->addDate = new \DateTime;
        $this->facePlaces = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * To String
     */
    public function __toString() {
        return $this->getFileOldName();
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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Video
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set addDate
     *
     * @param \DateTime $addDate
     *
     * @return Video
     */
    public function setAddDate($addDate)
    {
        $this->addDate = $addDate;

        return $this;
    }

    /**
     * Get addDate
     *
     * @return \DateTime
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Video
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
     * Set height
     *
     * @param integer $height
     *
     * @return Video
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
     * @return Video
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
     * @return Video
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
     * @return Video
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
     * @return Video
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
     * Set videoPoster
     *
     * @param string $videoPoster
     *
     * @return Video
     */
    public function setVideoPoster($videoPoster)
    {
        $this->videoPoster = $videoPoster;

        return $this;
    }

    /**
     * Get videoPoster
     *
     * @return string
     */
    public function getVideoPoster()
    {
        return $this->videoPoster;
    }

    /**
     * Set gpsLat
     *
     * @param string $gpsLat
     *
     * @return Video
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
     * @return Video
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
     * Set gpsRadius
     *
     * @param string $gpsRadius
     *
     * @return Video
     */
    public function setGpsRadius($gpsRadius)
    {
        $this->gpsRadius = $gpsRadius;

        return $this;
    }

    /**
     * Get gpsRadius
     *
     * @return string
     */
    public function getGpsRadius()
    {
        return $this->gpsRadius;
    }

    /**
     * Set infos
     *
     * @param string $infos
     *
     * @return Video
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
     * @return Video
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
     * Add comment
     *
     * @param \AppBundle\Entity\CommentVideo $comment
     *
     * @return Video
     */
    public function addComment(\AppBundle\Entity\CommentVideo $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\CommentVideo $comment
     */
    public function removeComment(\AppBundle\Entity\CommentVideo $comment)
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

    /**
     * Add file
     *
     * @param \AppBundle\Entity\VideoFile $file
     *
     * @return Video
     */
    public function addFile(\AppBundle\Entity\VideoFile $file)
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * Remove file
     *
     * @param \AppBundle\Entity\VideoFile $file
     */
    public function removeFile(\AppBundle\Entity\VideoFile $file)
    {
        $this->files->removeElement($file);
    }

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->getEvent()->getFolder()."/VIDEOS";
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiles()
    {
        return $this->files;
    }
}
