<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserEventViewed
 *
 * @ORM\Table(name="user_event_viewed")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserEventViewedRepository")
 */
class UserEventViewed
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event", inversedBy="viewedByUsers")
     * @ORM\JoinColumns({
     *    @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     *    })
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="seenEvents")
     * @ORM\JoinColumns({
     *    @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *    })
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="viewed_date", type="datetime", nullable=false)
     */
    private $viewedDate;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->viewedDate = new \DateTime;
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
     * Set viewedDate
     *
     * @param \DateTime $viewedDate
     *
     * @return UserEventViewed
     */
    public function setViewedDate($viewedDate)
    {
        $this->viewedDate = $viewedDate;

        return $this;
    }

    /**
     * Get viewedDate
     *
     * @return \DateTime
     */
    public function getViewedDate()
    {
        return $this->viewedDate;
    }

    /**
     * Set event
     *
     * @param \AppBundle\Entity\Event $event
     *
     * @return UserEventViewed
     */
    public function setEvent(\AppBundle\Entity\Event $event = null)
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserEventViewed
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
