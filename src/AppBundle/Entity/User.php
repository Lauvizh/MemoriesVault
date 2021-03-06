<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Face", cascade={"persist"}, mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $face;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Event", inversedBy="allowedUsers")
     * @ORM\JoinColumn(nullable=true)
     */
    private $viweableEvents;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserEventViewed", mappedBy="user")
     */
    private $seenEvents;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CommentEvent", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $CommentsEvent;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CommentPhoto", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $CommentsPhoto;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CommentVideo", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $CommentsVideo;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserConnection", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $connections;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->isActive = true;
        $this->roles = array('ROLE_USER');
        $this->addDate = new \Datetime;
    }

    /**
     * To String
     */
    public function __toString() {
        return $this->getFace()->getFullname();
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }



    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
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


    public function getRoles()
    {
        $roles = $this->roles;
        //$roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }


    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
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
     * @param \AppBundle\Entity\UserEventViewed $seenEvent
     *
     * @return User
     */
    public function addSeenEvent(\AppBundle\Entity\UserEventViewed $seenEvent)
    {
        $this->seenEvents[] = $seenEvent;

        return $this;
    }

    /**
     * Remove seenEvent
     *
     * @param \AppBundle\Entity\UserEventViewed $seenEvent
     */
    public function removeSeenEvent(\AppBundle\Entity\UserEventViewed $seenEvent)
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

    public function getName(){
        return $this->getFace()->getFullname();
    }


    /**
     * Add commentsEvent
     *
     * @param \AppBundle\Entity\CommentEvent $commentsEvent
     *
     * @return User
     */
    public function addCommentsEvent(\AppBundle\Entity\CommentEvent $commentsEvent)
    {
        $this->CommentsEvent[] = $commentsEvent;

        return $this;
    }

    /**
     * Remove commentsEvent
     *
     * @param \AppBundle\Entity\CommentEvent $commentsEvent
     */
    public function removeCommentsEvent(\AppBundle\Entity\CommentEvent $commentsEvent)
    {
        $this->CommentsEvent->removeElement($commentsEvent);
    }

    /**
     * Get commentsEvent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentsEvent()
    {
        return $this->CommentsEvent;
    }

    /**
     * Add commentsPhoto
     *
     * @param \AppBundle\Entity\CommentPhoto $commentsPhoto
     *
     * @return User
     */
    public function addCommentsPhoto(\AppBundle\Entity\CommentPhoto $commentsPhoto)
    {
        $this->CommentsPhoto[] = $commentsPhoto;

        return $this;
    }

    /**
     * Remove commentsPhoto
     *
     * @param \AppBundle\Entity\CommentPhoto $commentsPhoto
     */
    public function removeCommentsPhoto(\AppBundle\Entity\CommentPhoto $commentsPhoto)
    {
        $this->CommentsPhoto->removeElement($commentsPhoto);
    }

    /**
     * Get commentsPhoto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentsPhoto()
    {
        return $this->CommentsPhoto;
    }

    /**
     * Add commentsVideo
     *
     * @param \AppBundle\Entity\CommentVideo $commentsVideo
     *
     * @return User
     */
    public function addCommentsVideo(\AppBundle\Entity\CommentVideo $commentsVideo)
    {
        $this->CommentsVideo[] = $commentsVideo;

        return $this;
    }

    /**
     * Remove commentsVideo
     *
     * @param \AppBundle\Entity\CommentVideo $commentsVideo
     */
    public function removeCommentsVideo(\AppBundle\Entity\CommentVideo $commentsVideo)
    {
        $this->CommentsVideo->removeElement($commentsVideo);
    }

    /**
     * Get commentsVideo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentsVideo()
    {
        return $this->CommentsVideo;
    }
}
