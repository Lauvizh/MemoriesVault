<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use AppBundle\Entity\Media;

class MediaController extends Controller
{

    /**
     * @Route("/photo/{ratio}/{id}/{size}.{extention}", name="photo", requirements={"id": "\d+","size": "\d+"})
     */
    public function photoAction($id,$size=0,$ratio="original",$extention="jpg")
    {
    	
    	// construire le chemin vers le dossier de base des images
    	$basePath = $this->get('kernel')->getRootDir()."/../medias";
    	// si une taille est demandée et si elle est suppérieur à 1 on affiche la miniature demandée
    	// sinon on affiche l'image originale.
    	if (!empty($size) && $size > 1) {

    		$mediaPath = $basePath;
    		$mediaPath .= "/imagesdisplay/".sprintf("%08d",$id)."_".$size;
    		if ($ratio == "square") {
    			$mediaPath .= "_square";
    			}
    		$mediaPath .= ".".$extention;
    		if (!file_exists($mediaPath)) {
                // recuperer les informations du media
                $em = $this->getDoctrine()->getManager();
                $media = $em->getRepository('AppBundle:Media')->find($id);
    			$media->creatThumbnail($size, $basePath, $ratio);
                $em->flush();
    			}
    		}
    	else{
    		$mediaPath = $basePath."/".$media->getEvent()->getFolder()."/PHOTOS/".$media->getName();
    		}

		$response = new BinaryFileResponse($mediaPath);
		$response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE,sprintf("%08d",$id).".".$extention);

		return $response;
    }

}
