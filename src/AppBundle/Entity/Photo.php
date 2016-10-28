<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Imagick as Imagick;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhotoRepository")
 */
class Photo
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
     * @ORM\Column(name="file_stored", type="boolean", options={"default" : false})
     */
    private $fileStored;

    /**
     * @var string
     *
     * @ORM\Column(name="size_octet", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $sizeOctet;

    /**
     * @var string
     *
     * @ORM\Column(name="file_old_name", type="string", length=255, nullable=true)
     */
    private $fileOldName;

    /**
     * @var string
     *
     * @ORM\Column(name="extention", type="string", length=16, nullable=true)
     */
    private $extention;

    /**
     * @var string
     *
     * @ORM\Column(name="mime_type", type="string", length=64, nullable=true)
     */
    private $mimeType;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event", inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="add_date", type="datetime")
     */
    private $addDate;

    /**
     * @ORM\Column(name="metadata_scanned", type="boolean", options={"default" : false})
     */
    private $metadataScanned;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="capture_date", type="datetime", nullable=true)
     */
    private $captureDate;

    /**
     * @var string
     *
     * @ORM\Column(name="camera_model", type="string", length=255, nullable=true)
     */
    private $camera;

    /**
     * @var string
     *
     * @ORM\Column(name="camera_sn", type="string", length=255, nullable=true)
     */
    private $cameraSerialNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="focal", type="string", length=255, nullable=true)
     */
    private $focal;

    /**
     * @var string
     *
     * @ORM\Column(name="focal_35", type="string", length=255, nullable=true)
     */
    private $focal35;

    /**
     * @var string
     *
     * @ORM\Column(name="iso", type="string", length=255, nullable=true)
     */
    private $iso;

    /**
     * @var string
     *
     * @ORM\Column(name="speed", type="string", length=255, nullable=true)
     */
    private $speed;

    /**
     * @var string
     *
     * @ORM\Column(name="aperture", type="string", length=255, nullable=true)
     */
    private $aperture;

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
     * @ORM\Column(name="infos", type="string", length=6400, nullable=true)
     */
    private $infos;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FacePlace", mappedBy="photo", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $facePlaces;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CommentPhoto", mappedBy="photo", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        
        $this->fileStored = false;
        $this->addDate = new \DateTime;
        $this->facePlaces = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->metadataScanned = false;

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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fileStored
     *
     * @param boolean $fileStored
     *
     * @return Photo
     */
    public function setFileStored($fileStored)
    {
        $this->fileStored = $fileStored;

        return $this;
    }

    /**
     * Get fileStored
     *
     * @return boolean
     */
    public function getFileStored()
    {
        return $this->fileStored;
    }

    /**
     * Set sizeOctet
     *
     * @param string $sizeOctet
     *
     * @return Photo
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
     * Set fileOldName
     *
     * @param string $fileOldName
     *
     * @return Photo
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
     * Set extention
     *
     * @param string $extention
     *
     * @return Photo
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
     * Set mimeType
     *
     * @param string $mimeType
     *
     * @return Photo
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
     * Set addDate
     *
     * @param \DateTime $addDate
     *
     * @return Photo
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
     * Set captureDate
     *
     * @param \DateTime $captureDate
     *
     * @return Photo
     */
    public function setCaptureDate($captureDate)
    {
        $this->captureDate = $captureDate;

        return $this;
    }

    /**
     * Get captureDate
     *
     * @return \DateTime
     */
    public function getCaptureDate()
    {
        return $this->captureDate;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Photo
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
     * Set metadataScanned
     *
     * @param boolean $metadataScanned
     *
     * @return Photo
     */
    public function setMetadataScanned($metadataScanned)
    {
        $this->metadataScanned = $metadataScanned;

        return $this;
    }

    /**
     * Get metadataScanned
     *
     * @return boolean
     */
    public function getMetadataScanned()
    {
        return $this->metadataScanned;
    }

    /**
     * Set camera
     *
     * @param string $camera
     *
     * @return Photo
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
     * Set cameraSerialNumber
     *
     * @param string $cameraSerialNumber
     *
     * @return Photo
     */
    public function setCameraSerialNumber($cameraSerialNumber)
    {
        $this->cameraSerialNumber = $cameraSerialNumber;

        return $this;
    }

    /**
     * Get cameraSerialNumber
     *
     * @return string
     */
    public function getCameraSerialNumber()
    {
        return $this->cameraSerialNumber;
    }

    /**
     * Set focal
     *
     * @param string $focal
     *
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * Set gpsLat
     *
     * @param string $gpsLat
     *
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @return Photo
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
     * @param \AppBundle\Entity\CommentPhoto $comment
     *
     * @return Photo
     */
    public function addComment(\AppBundle\Entity\CommentPhoto $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\CommentPhoto $comment
     */
    public function removeComment(\AppBundle\Entity\CommentPhoto $comment)
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
     * Get folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->getEvent()->getFolder()."/PHOTOS";
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        $file = str_pad($this->getId(), 10, 0, STR_PAD_LEFT);
        $file .= ".";
        $file .= $this->getExtention();
        return $file;
    }

    /**
     * Creat Photo Thumbnail
     *
     * @return Photo
     */
    public function creatThumbnail($size, $basePath, $ratio){

        $fs = new Filesystem();

        $originalMadia = $basePath."/".$this->getEvent()->getFolder()."/PHOTOS/".$this->getFile();

        $displayfolder = $basePath."/imagesdisplay/".$size;

        if (!$fs->exists($displayfolder)) {
            try {
                $fs->mkdir($displayfolder);
            } catch (IOExceptionInterface $e) {
                echo "An error occurred while creating your directory at ".$e->getPath();
            }
        }

        $mediaPath = $displayfolder."/".str_pad($this->getId(), 10, 0, STR_PAD_LEFT);

        if ($ratio == "square") {
            $mediaPath .= "_square";
            }
        $mediaPath .= ".jpg";

        $h = $this->getHeight();
        $w = $this->getWidth();

        if (!$h || !$w) {
            list($w, $h, $itype, $iattr) = getimagesize($originalMadia);
            $this->setWidth($w);
            $this->setHeight($h);
            }

        // then calculate the resize perc based upon that dimension
        $p = ( $w < $h ) ? (100 / $w) * $size : (100 / $h) * $size;

        // define new width / height
        if (is_numeric($p)) {
            $nw = ceil($w / 100 * $p);
            $nh = ceil($h / 100 * $p);
            }

        $redim = new Imagick($originalMadia);

        if ($ratio == "square") {
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

        /**
     * Creat Photo Thumbnail
     *
     * @return Photo
     */
    public function metadataAnalysis($basePath){

        $fs = new Filesystem();

        $originalMadia = $basePath."/".$this->getEvent()->getFolder()."/PHOTOS/".$this->getFile();

        if (!$fs->exists($originalMadia)) {
            return $this;
            }

        $im = new \imagick($originalMadia);
        $imagedata = $im->getImageProperties();
        // echo "<pre>";
        // var_dump($imagedata);
        // echo "</pre>";
        // die();

        // Camera Model
        $make = "";
        if (@array_key_exists('exif:Make', $imagedata)) {
            $make = mb_convert_case(trim($imagedata['exif:Make']), MB_CASE_TITLE, "UTF-8");
            }
        $model = "";
        if (@array_key_exists('exif:Model', $imagedata)) {
            $model = mb_convert_case(trim($imagedata['exif:Model']), MB_CASE_TITLE, "UTF-8");
            }

        if ($make && $model) {
            $makemodel = "";
            if (!preg_match('#'.strtolower($make).'#', strtolower($model))) {
                $makemodel = $make." ".$model;
                }
            else{
                $makemodel = $model;
                }
            $this->setCamera($makemodel);
            }
        elseif ($make) {
            $this->setCamera($make);
            }
        elseif ($model) {
            $this->setCamera($model);
            }

        // Heigth
        if (@array_key_exists('exif:ExifImageLength', $imagedata)) {
            $this->setHeight(intval($imagedata['exif:ExifImageLength']));
            }

        // Width
        if (@array_key_exists('exif:ExifImageWidth', $imagedata)) {
            $this->setWidth(intval($imagedata['exif:ExifImageWidth']));
            }
        
        // Capture DateTime
        if (@array_key_exists('exif:DateTimeOriginal', $imagedata)) {
            $this->setCaptureDate(new \DateTime($imagedata['exif:DateTimeOriginal']));
            }

        // Exposure
        if (@array_key_exists('exif:ExposureTime', $imagedata)) {
            if (preg_match('#(\d+\/\d+)#', $imagedata['exif:ExposureTime'], $i)) {
                $this->setSpeed($i[1]);
                };
            }

        // Aperture
        $apertureData = null;
        if (@array_key_exists('exif:FNumber', $imagedata)) {
            if (preg_match('#f\/(\d+)[\.,]{0,1}(\d+)#', $imagedata['exif:FNumber'], $i)) {
                $apertureData = $i[1].".".$i[2];
                }
            }
        if (!$apertureData && @array_key_exists('exif:ApertureValue', $imagedata)) {
            if (preg_match('#f\/(\d+)[\.,]{0,1}(\d+)#', $imagedata['exif:ApertureValue'], $i)) {
                $apertureData = $i[1];
                }
            elseif (preg_match('#(\d+)\/(\d+)#', $imagedata['exif:ApertureValue'], $i)) {
                $apertureData = round(($i[1]/$i[2]),1,PHP_ROUND_HALF_ODD);
                }
            }

        $this->setAperture($apertureData);

        // ISO
        if (@array_key_exists('exif:ISOSpeedRatings',$imagedata)) {
            $this->setIso(intval($imagedata['exif:ISOSpeedRatings']));
            }

        // echo "<pre>";
        // \Doctrine\Common\Util\Debug::dump($this,2);
        // echo "</pre>";
        // die();

        $this->setMetadataScanned(true);

        return $this;

    }

}
