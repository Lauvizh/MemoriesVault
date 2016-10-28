<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Event;
use AppBundle\Entity\Photo;
use AppBundle\Form\PhotoType;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Photo controller.
 *
 * @Route("/admin/photo")
 */
class AdminPhotoController extends Controller
{
    /**
     * Lists all Photo entities.
     *
     * @Route("/event/{id}", name="admin_photo_index", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('AppBundle:Event')->find($id);
        $photos = $event->getPhotos();

        return $this->render('AppBundle:adminPhoto:index.html.twig', array(
            'event' => $event,
            'photos' => $photos,
        ));
    }

    /**
     * Creates a new Photo entity.
     *
     * @Route("/new", name="admin_photo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $photo = new Photo();
        $form = $this->createForm('AppBundle\Form\PhotoType', $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush();

            return $this->redirectToRoute('admin_photo_show', array('id' => $photo->getId()));
        }

        return $this->render('AppBundle:adminPhoto:new.html.twig', array(
            'photo' => $photo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Photo entity.
     *
     * @Route("/show/{id}", name="admin_photo_show")
     * @Method("GET")
     */
    public function showAction(Photo $photo)
    {
        $deleteForm = $this->createDeleteForm($photo);

        return $this->render('AppBundle:adminPhoto:show.html.twig', array(
            'photo' => $photo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Photo entity.
     *
     * @Route("/edit/{id}", name="admin_photo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Photo $photo)
    {
        $deleteForm = $this->createDeleteForm($photo);
        $editForm = $this->createForm('AppBundle\Form\PhotoType', $photo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush();

            return $this->redirectToRoute('admin_photo_edit', array('id' => $photo->getId()));
        }

        return $this->render('AppBundle:adminPhoto:edit.html.twig', array(
            'photo' => $photo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Photo entity.
     *
     * @Route("/delete/{id}", name="admin_photo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Photo $photo)
    {
        $form = $this->createDeleteForm($photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($photo);
            $em->flush();
        }

        return $this->redirectToRoute('admin_photo_index');
    }

    /**
     * Creates a form to delete a Photo entity.
     *
     * @param Photo $photo The Photo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Photo $photo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_photo_delete', array('id' => $photo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Upload Multiple photo entities.
     *
     * @Route("/upload", name="admin_photo_upload")
     * @Method({"GET", "POST"})
     */
    public function uploadAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\MediaUploadType');
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $fs = new Filesystem();
            $newPhotos = array();
            $tmpNameSalt = md5(rand().time());
            $em = $this->getDoctrine()->getManager();
            $basePath = $this->get('kernel')->getRootDir()."/../medias";
            $tmpFolder = $basePath."/tmp";


            $files = $form->get('files')->getData();
            if ($files) {
                foreach ($files as $file) {


                    $p = new Photo();
                    $p->setEvent($form->get('event')->getData());
                    $p->setFileOldName($file->getClientOriginalName());
                    $p->setExtention($file->getClientOriginalExtension());
                    
                    $p->setMimeType($file->getClientMimeType());
                    $p->setSizeOctet($file->getClientSize());

                    $file->move($tmpFolder, $tmpNameSalt."-".$file->getClientOriginalName());

                    $em->persist($p);

                    $newPhotos[] = $p;

                    }
                }

                $em->flush();

                foreach ($newPhotos as $newPhoto) {
                    $fs->rename($tmpFolder."/".$tmpNameSalt."-".$newPhoto->getFileOldName(), $basePath."/".str_pad($newPhoto->getEvent()->getId(), 6, 0, STR_PAD_LEFT)."/PHOTOS/".str_pad($newPhoto->getId(), 10, 0, STR_PAD_LEFT).".".$newPhoto->getExtention());
                    $newPhoto->setFileStored(true);
                    $newPhoto->metadataAnalysis($basePath);
                    }

                $em->flush();

                \Doctrine\Common\Util\Debug::dump($newPhoto,2);

            }
        return $this->render('AppBundle:adminMedia:upload.html.twig', array(
            'upload_form' => $form->createView(),
            ));
    }
}
