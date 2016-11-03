<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use AppBundle\Entity\Video;
use AppBundle\Entity\VideoFile;

class VideoController extends Controller
{

    /**
     * @Route("/video/{id}.{extention}", name="video", requirements={"id": "\d+", "extention":"webm|mp4|ogg"})
     */
    public function videoAction($id,$extention)
    {
        
        // construire le chemin vers le dossier de base des images
        $basePath = $this->get('kernel')->getRootDir()."/../medias";
        // si une taille est demandée et si elle est suppérieur à 1 on affiche la miniature demandée
        // sinon on affiche l'image originale.

        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('AppBundle:Video')->find($id);
        $mediaPath = $basePath."/".$media->getEvent()->getFolder()."/VIDEOS/".str_pad($id, 10, 0, STR_PAD_LEFT).".".$extention;

        if (!file_exists($mediaPath)) {
            throw new NotFoundHttpException('Sorry, video file does not exist!');
            }

        $response = new BinaryFileResponse($mediaPath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE,str_pad($id, 10, 0, STR_PAD_LEFT).".".$extention);

        return $response;
    }

    /**
     * @Route("/videoposter/{id}", name="videoposter", requirements={"id": "\d+"})
     */
    public function videoposterAction($id)
    {
        
        // construire le chemin vers le dossier de base des images
        $basePath = $this->get('kernel')->getRootDir()."/../medias";
        
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('AppBundle:Video')->find($id);
        if (!$media->getvideoPoster()) {
            throw new NotFoundHttpException('Sorry, no video poster recorded!');
        }
        $mediaPath = $basePath."/".$media->getEvent()->getFolder()."/VIDEOS/".$media->getvideoPoster();
        if (!file_exists($mediaPath)) {
            throw new NotFoundHttpException('Sorry, video poster does not exist!');
            }

        $response = new BinaryFileResponse($mediaPath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE,$media->getvideoPoster());

        return $response;
    }
}
