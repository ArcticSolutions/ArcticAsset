<?php

namespace Arctic\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DashboardController extends Controller
{
    /**
     * @Route("/")
     * @Template("")
     */
    public function dashboardAction()
    {
        return array('title' => 'Dashboard');
    }
}
