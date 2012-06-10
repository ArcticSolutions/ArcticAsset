<?php

namespace Artic\AssetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('ArticAssetBundle:Default:index.html.twig', array('name' => $name));
    }
}
