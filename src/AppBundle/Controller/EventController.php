<?php
// src/Acme/ArticleBundle/Controller/ArticleController.php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Event;

class EventController extends Controller
{
	/**
     * @Route("/eventlist", name="eventlist")
     */
    public function EventListItemAction($events)
    {
        return $this->render(
            'AppBundle:event:eventListItem.html.twig',
            array('events' => $events)
        );
    }

    /**
     * @Route("/event/{id}", name="event", requirements={"id": "\d+"})
     */
    public function eventAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('AppBundle:Event')->find($id);

        return $this->render('AppBundle:event:event.html.twig' , array('event'=>$event));
    }

    /**
     * @Route("/archive/{page}", name="archive", requirements={"page": "\d+"})
     */
    public function archiveAction($page=1, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('AppBundle:Event')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', $page)/*page number*/,
            10/*limit per page*/

        );
        
        $pagination->setUsedRoute('lf_event_archive');

        return $this->render('AppBundle:event:archive.html.twig', array('pagination'=>$pagination));
    }
}
