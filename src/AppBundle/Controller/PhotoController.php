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
     * @Route("/photo/{ratio}/{id}/{size}.{extention}", name="photo", requirements={"id": "\d+","ratio":"original|square","size": "\d+"})
     */
    public function photoAction($id,$size=0,$ratio="original",$extention="jpg")
    {
    	
    	// construire le chemin vers le dossier de base des images
    	$basePath = $this->get('kernel')->getRootDir()."/../medias";
    	// si une taille est demandée et si elle est suppérieur à 1 on affiche la miniature demandée
    	// sinon on affiche l'image originale.
    	if (!empty($size) && $size > 1) {

    		$photoPath = $basePath;
    		$photoPath .= "/imagesdisplay/".$size."/".str_pad($id, 10, 0, STR_PAD_LEFT);
    		if ($ratio == "square") {
    			$photoPath .= "_square";
    			}
    		$photoPath .= ".".$extention;
    		if (!file_exists($photoPath)) {
                // recuperer les informations du media
                $em = $this->getDoctrine()->getManager();
                $photo = $em->getRepository('AppBundle:Photo')->find($id);
    			$photo->creatThumbnail($size, $basePath, $ratio);
                if (!$photo->getMetadataScanned()) {
                    $photo->metadataAnalysis($basePath);
                    }
                $em->flush();
    			}
    		}
    	else{
            $em = $this->getDoctrine()->getManager();
            $photo = $em->getRepository('AppBundle:Photo')->find($id);
    		$photoPath = $basePath."/".$photo->getEvent()->getFolder()."/PHOTOS/".$photo->getFile();
            if (!file_exists($photoPath)) {
                throw new NotFoundHttpException('Sorry, video photo does not exist!');
                }
    		}

		$response = new BinaryFileResponse($photoPath);
		$response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE,str_pad($id, 10, 0, STR_PAD_LEFT).".".$extention);

		return $response;
    }

    /**
     * @Route("/photo/data/{id}", name="photo_data", requirements={"id": "\d+"})
     */
    public function photoDataAction($id)
    {
        $basePath = $this->get('kernel')->getRootDir()."/../medias";
        $em = $this->getDoctrine()->getManager();
        $photo = $em->getRepository('AppBundle:Photo')->find($id);
        if (!$photo->getMetadataScanned()) {
            $photo->metadataAnalysis($basePath);
            }

        echo "<pre>";
        \Doctrine\Common\Util\Debug::dump($photo,3);
        echo "</pre>";
        die();
    }


    /**
     * @Route("/photo/details/{id}", name="photo_details", requirements={"id": "\d+"})
     */
    public function photoDetailsAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $photo = $em->getRepository('AppBundle:Photo')->find($id);
        $prev  = $em->getRepository('AppBundle:Photo')->findPreviousPhoto($photo)->getOneOrNullResult();
        // if not prev
        // get last photo of event
        if (!$prev) {
            $prev = $photo->getEvent()->getPhotos()->first();
            }
        $next  = $em->getRepository('AppBundle:Photo')->findNextPhoto($photo)->getOneOrNullResult();
        // if not next
        // get first photo of event
        if (!$next) {
            $next = $photo->getEvent()->getPhotos()->last();
            }
        return $this->render('AppBundle:photo:details.html.twig', array('photo'=>$photo, 'next'=>$next, 'prev'=>$prev));
    }
}
