<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MediaComment
 *
 * @ORM\Table(name="media_comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MediaCommentRepository")
 */
class MediaComment
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
     * @ORM\Column(name="content", type="string", length=6400)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Media", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $media;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="mediaComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    
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
     * Set content
     *
     * @param string $content
     *
     * @return MediaComment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return MediaComment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set media
     *
     * @param \LF\MediasBundle\Entity\Media $media
     *
     * @return MediaComment
     */
    public function setMedia(\AppBundle\Entity\Media $media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \LF\MediasBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }
}
