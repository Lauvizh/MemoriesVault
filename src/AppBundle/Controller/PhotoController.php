<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use AppBundle\Entity\Photo;

class PhotoController extends Controller
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
    		$mediaPath .= "/imagesdisplay/".$size."/".str_pad($id, 10, 0, STR_PAD_LEFT);
    		if ($ratio == "square") {
    			$mediaPath .= "_square";
    			}
    		$mediaPath .= ".".$extention;
    		if (!file_exists($mediaPath)) {
                // recuperer les informations du media
                $em = $this->getDoctrine()->getManager();
                $media = $em->getRepository('AppBundle:Photo')->find($id);
    			$media->creatThumbnail($size, $basePath, $ratio);
                if (!$media->getMetadataScanned()) {
                    $media->metadataAnalysis($basePath);
                    }
                $em->flush();
    			}
    		}
    	else{
            $em = $this->getDoctrine()->getManager();
            $media = $em->getRepository('AppBundle:Photo')->find($id);
    		$mediaPath = $basePath."/".$media->getEvent()->getFolder()."/PHOTOS/".$media->getFile();
            if (!file_exists($mediaPath)) {
                throw new NotFoundHttpException('Sorry, video photo does not exist!');
                }
    		}

		$response = new BinaryFileResponse($mediaPath);
		$response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE,str_pad($id, 10, 0, STR_PAD_LEFT).".".$extention);

		return $response;
    }


}
