<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;

class AdminController extends Controller
{
	/**
     * @Route("/admin", name="admin")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:admin:index.html.twig');
    }
}
