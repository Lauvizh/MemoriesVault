<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserConnection
 *
 * @ORM\Table(name="user_connection")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserConnectionRepository")
 */
class UserConnection
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="connections")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="connection_date", type="datetime")
     */
    private $connectionDate;

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
     * Set connectionDate
     *
     * @param \DateTime $connectionDate
     *
     * @return UserConnection
     */
    public function setConnectionDate($connectionDate)
    {
        $this->connectionDate = $connectionDate;

        return $this;
    }

    /**
     * Get connectionDate
     *
     * @return \DateTime
     */
    public function getConnectionDate()
    {
        return $this->connectionDate;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserConnection
     */
    public function setUser(\AppBundle\Entity\User $user)
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
