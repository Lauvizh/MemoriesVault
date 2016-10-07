<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Face;
use AppBundle\Form\FaceType;

/**
 * Face controller.
 *
 * @Route("/admin/face")
 */
class AdminFaceController extends Controller
{
    /**
     * Lists all Face entities.
     *
     * @Route("/", name="admin_face_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $faces = $em->getRepository('AppBundle:Face')->findAll();

        return $this->render('face/index.html.twig', array(
            'faces' => $faces,
        ));
    }

    /**
     * Creates a new Face entity.
     *
     * @Route("/new", name="admin_face_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $face = new Face();
        $form = $this->createForm('AppBundle\Form\FaceType', $face);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($face);
            $em->flush();

            return $this->redirectToRoute('admin_face_show', array('id' => $face->getId()));
        }

        return $this->render('face/new.html.twig', array(
            'face' => $face,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Face entity.
     *
     * @Route("/{id}", name="admin_face_show")
     * @Method("GET")
     */
    public function showAction(Face $face)
    {
        $deleteForm = $this->createDeleteForm($face);

        return $this->render('face/show.html.twig', array(
            'face' => $face,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Face entity.
     *
     * @Route("/{id}/edit", name="admin_face_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Face $face)
    {
        $deleteForm = $this->createDeleteForm($face);
        $editForm = $this->createForm('AppBundle\Form\FaceType', $face);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($face);
            $em->flush();

            return $this->redirectToRoute('admin_face_edit', array('id' => $face->getId()));
        }

        return $this->render('face/edit.html.twig', array(
            'face' => $face,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Face entity.
     *
     * @Route("/{id}", name="admin_face_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Face $face)
    {
        $form = $this->createDeleteForm($face);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($face);
            $em->flush();
        }

        return $this->redirectToRoute('admin_face_index');
    }

    /**
     * Creates a form to delete a Face entity.
     *
     * @param Face $face The Face entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Face $face)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_face_delete', array('id' => $face->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
