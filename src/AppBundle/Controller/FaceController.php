<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Face;

class FaceController extends Controller
{
    public function indexAction()
    {
        return $this->render('LFFaceBundle:Default:index.html.twig');
    }
}
