<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;

class UserController extends Controller
{
	/**
     * @Route("/user", name="user")
     */
    public function indexAction()
    {
        return $this->render('LFUserBundle:Default:index.html.twig');
    }
}
