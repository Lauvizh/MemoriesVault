<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VideoFile
 *
 * @ORM\Table(name="video_file")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VideoFileRepository")
 */
class VideoFile
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="files")
     * @ORM\JoinColumn(nullable=false)
     */
    private $video;

    /**
     * @var string
     *
     * @ORM\Column(name="mime_type", type="string", length=64, nullable=true)
     */
    private $mimeType;

    /**
     * @var string
     *
     * @ORM\Column(name="extention", type="string", length=16, nullable=true)
     */
    private $extention;

    /**
     * @var string
     *
     * @ORM\Column(name="file_old_name", type="string", length=255, nullable=true)
     */
    private $fileOldName;

    /**
     * @var string
     *
     * @ORM\Column(name="size_octet", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $sizeOctet;

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
     * Set mimeType
     *
     * @param string $mimeType
     *
     * @return VideoFile
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set extention
     *
     * @param string $extention
     *
     * @return VideoFile
     */
    public function setExtention($extention)
    {
        $this->extention = $extention;

        return $this;
    }

    /**
     * Get extention
     *
     * @return string
     */
    public function getExtention()
    {
        return $this->extention;
    }

    /**
     * Set fileOldName
     *
     * @param string $fileOldName
     *
     * @return VideoFile
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
     * Set sizeOctet
     *
     * @param string $sizeOctet
     *
     * @return VideoFile
     */
    public function setSizeOctet($sizeOctet)
    {
        $this->sizeOctet = $sizeOctet;

        return $this;
    }

    /**
     * Get sizeOctet
     *
     * @return string
     */
    public function getSizeOctet()
    {
        return $this->sizeOctet;
    }

    /**
     * Set video
     *
     * @param \AppBundle\Entity\Video $video
     *
     * @return VideoFile
     */
    public function setVideo(\AppBundle\Entity\Video $video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \AppBundle\Entity\Video
     */
    public function getVideo()
    {
        return $this->video;
    }
}
