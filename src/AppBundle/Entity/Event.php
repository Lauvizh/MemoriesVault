<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria as Criteria;
use Doctrine\common\Collections\ArrayCollection;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

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
     * @ORM\Column(name="summary", type="string", length=6400)
     */
    private $summary;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime")
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_date", type="datetime", nullable=true)
     */
    private $modifiedDate;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Theme", inversedBy="events")
     * @ORM\JoinTable(name="theme_event",
     *     joinColumns={@ORM\JoinColumn(name="event_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="theme_id", referencedColumnName="id")}
     * )
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $themes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CommentEvent", mappedBy="event", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Photo", mappedBy="event")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\OrderBy({"captureDate" = "DESC"})
     */
    private $photos;

    /**
     * @var int
     *
     * @ORM\Column(name="count_photos", type="integer", nullable=true)
     */
    private $countPhotos;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Video", mappedBy="event")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\OrderBy({"startDate" = "DESC"})
     */
    private $videos;

    /**
     * @var int
     *
     * @ORM\Column(name="count_videos", type="integer", nullable=true)
     */
    private $countVideos;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="viweableEvents")
     * @ORM\JoinColumn(nullable=true)
     */
    private $allowedUsers;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserEventViewed", mappedBy="event")
     */
    private $viewedByUsers;

    /**
     * @ORM\Column(name="is_active", type="boolean", options={"default" : false})
     */
    private $isActive;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->themes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->videos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdDate = $this->modifiedDate = new \DateTime();
        $this->countPhotos = $this->countVideos = 0;
        $this->isActive = false;
    }

    /**
     * To String
     */
    public function __toString() {
        return $this->getTitle();
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
     * Set title
     *
     * @param string $title
     *
     * @return Event
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
     * Get folder
     *
     * @return string
     */
    public function getFolder()
    {
        return str_pad($this->getId(), 6, 0, STR_PAD_LEFT);
    }
    
    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Event
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
     * @return Event
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
     * Set summary
     *
     * @param string $summary
     *
     * @return Event
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Event
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set modifiedDate
     *
     * @param \DateTime $modifiedDate
     *
     * @return Event
     */
    public function setModifiedDate($modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;

        return $this;
    }

    /**
     * Get modifiedDate
     *
     * @return \DateTime
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }

    /**
     * Set countPhotos
     *
     * @param integer $countPhotos
     *
     * @return Event
     */
    public function setCountPhotos($countPhotos)
    {
        $this->countPhotos = $countPhotos;

        return $this;
    }

    /**
     * Get countPhotos
     *
     * @return integer
     */
    public function getCountPhotos()
    {
        return $this->countPhotos;
    }

    /**
     * Set countVideos
     *
     * @param integer $countVideos
     *
     * @return Event
     */
    public function setCountVideos($countVideos)
    {
        $this->countVideos = $countVideos;

        return $this;
    }

    /**
     * Get countVideos
     *
     * @return integer
     */
    public function getCountVideos()
    {
        return $this->countVideos;
    }

    /**
     * Add theme
     *
     * @param \AppBundle\Entity\Theme $theme
     *
     * @return Event
     */
    public function addTheme(\AppBundle\Entity\Theme $theme)
    {
        $this->themes[] = $theme;

        return $this;
    }

    /**
     * Remove theme
     *
     * @param \AppBundle\Entity\Theme $theme
     */
    public function removeTheme(\AppBundle\Entity\Theme $theme)
    {
        $this->themes->removeElement($theme);
    }

    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\CommentEvent $comment
     *
     * @return Event
     */
    public function addComment(\AppBundle\Entity\CommentEvent $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\CommentEvent $comment
     */
    public function removeComment(\AppBundle\Entity\CommentEvent $comment)
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
     * Add allowedUser
     *
     * @param \AppBundle\Entity\User $allowedUser
     *
     * @return Event
     */
    public function addAllowedUser(\AppBundle\Entity\User $allowedUser)
    {
        $this->allowedUsers[] = $allowedUser;

        return $this;
    }

    /**
     * Remove allowedUser
     *
     * @param \AppBundle\Entity\User $allowedUser
     */
    public function removeAllowedUser(\AppBundle\Entity\User $allowedUser)
    {
        $this->allowedUsers->removeElement($allowedUser);
    }

    /**
     * Get allowedUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAllowedUsers()
    {
        return $this->allowedUsers;
    }

    /**
     * Add viewedByUser
     *
     * @param \AppBundle\Entity\User $viewedByUser
     *
     * @return Event
     */
    public function addViewedByUser(\AppBundle\Entity\User $viewedByUser)
    {
        $this->viewedByUsers[] = $viewedByUser;

        return $this;
    }

    /**
     * Remove viewedByUser
     *
     * @param \AppBundle\Entity\User $viewedByUser
     */
    public function removeViewedByUser(\AppBundle\Entity\User $viewedByUser)
    {
        $this->viewedByUsers->removeElement($viewedByUser);
    }

    /**
     * Get viewedByUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getViewedByUsers()
    {
        return $this->viewedByUsers;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Event
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
     * Add photo
     *
     * @param \AppBundle\Entity\Photo $photo
     *
     * @return Event
     */
    public function addPhoto(\AppBundle\Entity\Photo $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \AppBundle\Entity\Photo $photo
     */
    public function removePhoto(\AppBundle\Entity\Photo $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get First Photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFirstsPhotos($nb = 4)
    {

        $criteria = Criteria::create()
        ->orderBy(array('captureDate'=> Criteria::ASC))
        ->setMaxResults($nb);

        return $this->photos->matching($criteria);
    }

    /**
     * Get Photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add video
     *
     * @param \AppBundle\Entity\Video $video
     *
     * @return Event
     */
    public function addVideo(\AppBundle\Entity\Video $video)
    {
        $this->videos[] = $video;

        return $this;
    }

    /**
     * Remove video
     *
     * @param \AppBundle\Entity\Video $video
     */
    public function removeVideo(\AppBundle\Entity\Video $video)
    {
        $this->videos->removeElement($video);
    }

    /**
     * Get Videos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVideos()
    {
        return $this->videos;
    }
}
