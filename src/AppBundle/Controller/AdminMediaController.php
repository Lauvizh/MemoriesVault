<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Media;
use AppBundle\Form\MediaType;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Media controller.
 *
 * @Route("/admin/media")
 */
class AdminMediaController extends Controller
{
    /**
     * Lists all Media entities.
     *
     * @Route("/{page}", name="admin_media_index", requirements={"page": "\d+"})
     */
    public function indexAction($page=1, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('AppBundle:Media')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', $page)/*page number*/,
            25/*limit per page*/

            );
        
        $pagination->setUsedRoute('admin_media_index');

        return $this->render('AppBundle:adminMedia:index.html.twig', array(
            'media' => $pagination,
        ));
    }

    // *
    //  * Creates a new Media entity.
    //  *
    //  * @Route("/new", name="admin_media_new")
    //  * @Method({"GET", "POST"})
     
    // public function newAction(Request $request)
        // {
        //     $medium = new Media();
        //     $form = $this->createForm('AppBundle\Form\MediaType', $medium);
        //     $form->handleRequest($request);

        //     if ($form->isSubmitted() && $form->isValid()) {
        //         $em = $this->getDoctrine()->getManager();
        //         $em->persist($medium);
        //         $em->flush();

        //         return $this->redirectToRoute('admin_media_show', array('id' => $medium->getId()));
        //     }

        //     return $this->render('AppBundle:adminMedia:new.html.twig', array(
        //         'medium' => $medium,
        //         'form' => $form->createView(),
        //     ));
    // }

    /**
     * Upload Multiple media entities.
     *
     * @Route("/upload", name="admin_media_upload")
     * @Method({"GET", "POST"})
     */
    public function uploadAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\MediaUploadType');
        $form->handleRequest($request);

        

        if ($form->isSubmitted()) {

            $fs = new Filesystem();
            $newMadias = array();
            $tmpNameSalt = md5(rand().time());
            $em = $this->getDoctrine()->getManager();
            $basePath = $this->get('kernel')->getRootDir()."/../medias";
            $tmpFolder = $basePath."/tmp";


            $files = $form->get('files')->getData();
            if ($files) {
                foreach ($files as $file) {
                    $m = new Media();
                    $m->setFileOldName($file->getClientOriginalName());
                    $m->setExtention($file->getClientOriginalExtension());
                    $m->setEvent($form->get('event')->getData());

                    $mime = $file->getClientMimeType();

                    switch ($mime) {
                        case (preg_match('#image\/*#', $mime) ? true : false) :
                            $m->setType('pho');
                            break;
                        case (preg_match('#video\/*#', $mime) ? true : false) :
                            $m->setType('vid');
                            break;
                        }

                    $m->setMimeType($mime);
                    $m->setSizeKo(round($file->getClientSize()/1024,0));

                    $file->move($tmpFolder, $tmpNameSalt."-".$file->getClientOriginalName());

                    $em->persist($m);

                    $newMadias[] = $m;

                    }
                }

                $em->flush();

                foreach ($newMadias as $newMadia) {
                    $subFolder = "PHOTOS";
                    if ($newMadia->getType() == "vid") {
                        $subFolder = "VIDEOS";
                        }


                    $fs->rename($tmpFolder."/".$tmpNameSalt."-".$newMadia->getFileOldName(), $basePath."/".str_pad($newMadia->getEvent()->getId(), 6, 0, STR_PAD_LEFT)."/".$subFolder."/".str_pad($newMadia->getId(), 10, 0, STR_PAD_LEFT).".".$newMadia->getExtention());
                    }

                \Doctrine\Common\Util\Debug::dump($newMadias,2);

            }
        return $this->render('AppBundle:adminMedia:upload.html.twig', array(
            'upload_form' => $form->createView(),
            ));
    }

    /**
     * Finds and displays a Media entity.
     *
     * @Route("/show/{id}", name="admin_media_show")
     * @Method("GET")
     */
    public function showAction(Media $medium)
    {
        $deleteForm = $this->createDeleteForm($medium);

        return $this->render('AppBundle:adminMedia:show.html.twig', array(
            'medium' => $medium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Media entity.
     *
     * @Route("/edit/{id}", name="admin_media_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Media $medium)
    {
        $deleteForm = $this->createDeleteForm($medium);
        $editForm = $this->createForm('AppBundle\Form\MediaType', $medium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medium);
            $em->flush();

            return $this->redirectToRoute('admin_media_edit', array('id' => $medium->getId()));
        }

        return $this->render('AppBundle:adminMedia:edit.html.twig', array(
            'medium' => $medium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Media entity.
     *
     * @Route("/delete/{id}", name="admin_media_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Media $medium)
    {
        $form = $this->createDeleteForm($medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medium);
            $em->flush();
        }

        return $this->redirectToRoute('admin_media_index');
    }

    /**
     * Creates a form to delete a Media entity.
     *
     * @param Media $medium The Media entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Media $medium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_media_delete', array('id' => $medium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
