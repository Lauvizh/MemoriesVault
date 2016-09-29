<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="add_date", type="datetime")
     */
    private $addDate;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Face", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $face;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Event", inversedBy="allowedUsers")
     * @ORM\JoinColumn(nullable=true)
     */
    private $viweableEvents;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Event", inversedBy="viewedByUsers")
     * @ORM\JoinColumn(nullable=true)
     */
    private $seenEvents;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EventComment", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $eventComments;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MediaComment", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $mediaComments;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserConnection", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $connections;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set addDate
     *
     * @param \DateTime $addDate
     *
     * @return User
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
     * Set face
     *
     * @param \AppBundle\Entity\Face $face
     *
     * @return User
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
     * Add viweableEvent
     *
     * @param \AppBundle\Entity\Event $viweableEvent
     *
     * @return User
     */
    public function addViweableEvent(\AppBundle\Entity\Event $viweableEvent)
    {
        $this->viweableEvents[] = $viweableEvent;

        return $this;
    }

    /**
     * Remove viweableEvent
     *
     * @param \AppBundle\Entity\Event $viweableEvent
     */
    public function removeViweableEvent(\AppBundle\Entity\Event $viweableEvent)
    {
        $this->viweableEvents->removeElement($viweableEvent);
    }

    /**
     * Get viweableEvents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getViweableEvents()
    {
        return $this->viweableEvents;
    }

    /**
     * Add seenEvent
     *
     * @param \AppBundle\Entity\Event $seenEvent
     *
     * @return User
     */
    public function addSeenEvent(\AppBundle\Entity\Event $seenEvent)
    {
        $this->seenEvents[] = $seenEvent;

        return $this;
    }

    /**
     * Remove seenEvent
     *
     * @param \AppBundle\Entity\Event $seenEvent
     */
    public function removeSeenEvent(\AppBundle\Entity\Event $seenEvent)
    {
        $this->seenEvents->removeElement($seenEvent);
    }

    /**
     * Get seenEvents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeenEvents()
    {
        return $this->seenEvents;
    }

    /**
     * Add eventComment
     *
     * @param \AppBundle\Entity\EventComment $eventComment
     *
     * @return User
     */
    public function addEventComment(\AppBundle\Entity\EventComment $eventComment)
    {
        $this->eventComments[] = $eventComment;

        return $this;
    }

    /**
     * Remove eventComment
     *
     * @param \AppBundle\Entity\EventComment $eventComment
     */
    public function removeEventComment(\AppBundle\Entity\EventComment $eventComment)
    {
        $this->eventComments->removeElement($eventComment);
    }

    /**
     * Get eventComments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventComments()
    {
        return $this->eventComments;
    }

    /**
     * Add mediaComment
     *
     * @param \AppBundle\Entity\MediaComment $mediaComment
     *
     * @return User
     */
    public function addMediaComment(\AppBundle\Entity\MediaComment $mediaComment)
    {
        $this->mediaComments[] = $mediaComment;

        return $this;
    }

    /**
     * Remove mediaComment
     *
     * @param \AppBundle\Entity\MediaComment $mediaComment
     */
    public function removeMediaComment(\AppBundle\Entity\MediaComment $mediaComment)
    {
        $this->mediaComments->removeElement($mediaComment);
    }

    /**
     * Get mediaComments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMediaComments()
    {
        return $this->mediaComments;
    }

    /**
     * Add connection
     *
     * @param \AppBundle\Entity\UserConnection $connection
     *
     * @return User
     */
    public function addConnection(\AppBundle\Entity\UserConnection $connection)
    {
        $this->connections[] = $connection;

        return $this;
    }

    /**
     * Remove connection
     *
     * @param \AppBundle\Entity\UserConnection $connection
     */
    public function removeConnection(\AppBundle\Entity\UserConnection $connection)
    {
        $this->connections->removeElement($connection);
    }

    /**
     * Get connections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConnections()
    {
        return $this->connections;
    }
}
