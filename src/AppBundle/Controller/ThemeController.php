<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Theme;

class ThemeController extends Controller
{
    /**
     * @Route("/getAllThemesMenu", name="getAllThemesMenu")
     */
    public function getAllThemesMenuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $allThemes = $em->getRepository('AppBundle:Theme')->findAll();
        // $allThemes = array(
        //  array('id'=>1,'nom'=>'theme1')
        //  );
        return $this->render(
            'AppBundle:Theme:themeMenuList.html.twig',
            array('allThemes' => $allThemes)
        );
    }
}
