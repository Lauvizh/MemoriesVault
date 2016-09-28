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
}

