<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Media;
use AppBundle\Form\MediaType;

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
            50/*limit per page*/

            );
        
        $pagination->setUsedRoute('archive');

        return $this->render('AppBundle:adminMedia:index.html.twig', array(
            'media' => $pagination,
        ));
    }

    /**
     * Creates a new Media entity.
     *
     * @Route("/new", name="admin_media_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $medium = new Media();
        $form = $this->createForm('AppBundle\Form\MediaType', $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medium);
            $em->flush();

            return $this->redirectToRoute('admin_media_show', array('id' => $medium->getId()));
        }

        return $this->render('AppBundle:adminMedia:new.html.twig', array(
            'medium' => $medium,
            'form' => $form->createView(),
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
