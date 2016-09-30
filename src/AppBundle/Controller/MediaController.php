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
     * @Route("/photo/{id}/{size}/{squared}", name="photo", requirements={"id": "\d+","size": "\d+","squared": "\d+"})
     */
    public function photoAction($id,$size=0,$squared=0)
    {
    	// recuperer les informations du media
    	$em = $this->getDoctrine()->getManager();
    	$media = $em->getRepository('AppBundle:Media')->find($id);
    	// construire le chemin vers le dossier de base des images
    	$basePath = $this->container->getParameter('kernel.root_dir')."/../medias";
    	// si une taille est demandée et si elle est suppérieur à 1 on affiche la miniature demandée
    	// sinon on affiche l'image originale.
    	if (!empty($size) && $size > 1) {

    		$mediaPath = $basePath;
    		$mediaPath .= "/imagesdisplay/".sprintf("%08d",$media->getEvent()->getId())."/".sprintf("%08d",$media->getId())."_".$size;
    		if ($squared > 0) {
    			$mediaPath .= "_sq";
    			}
    		$mediaPath .= ".jpg";
    		if (!file_exists($mediaPath)) {
    			$media->creatThumbnail($size, $basePath, $squared);
    			}
    		}
    	else{
    		$mediaPath = $basePath."/".$media->getFolder()."/PHOTOS/".$media->getName();
    		}

		$response = new BinaryFileResponse($mediaPath);
		$response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE,$media->getFileOldName());

		return $response;
    }

}
