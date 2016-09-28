<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Theme;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $themesHomePage = $em->getRepository('AppBundle:Theme')->findBy(array('homePage' => true), array('name' => 'ASC'), 10, 0);

        return $this->render('AppBundle:HomePage:homepage.html.twig', array('themesHomePage' => $themesHomePage));
    }

}
