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
     * @Route("/event/{id}/{page}", name="event", requirements={"id": "\d+", "page":"\d+"})
     */
    public function eventAction($id, $page=1, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('AppBundle:Event')->find($id);

        $query_photos = $em->getRepository('AppBundle:Media')->findPhotosByEvent($event);

        $paginator  = $this->get('knp_paginator');
        $paginated_medias = $paginator->paginate(
            $query_photos, /* query NOT result */
            $request->query->getInt('page', $page)/*page number*/,
            50/*limit per page*/

        );
        
        $paginated_medias->setUsedRoute('event');

        return $this->render('AppBundle:event:event.html.twig' , array('event'=>$event, 'medias'=>$paginated_medias));
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
        
        $pagination->setUsedRoute('archive');

        return $this->render('AppBundle:event:archive.html.twig', array('pagination'=>$pagination));
    }
}
