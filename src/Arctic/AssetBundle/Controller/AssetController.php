<?php

namespace Arctic\AssetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arctic\AssetBundle\Form\AssetType;

class AssetController extends Controller
{
    /**
     * @Route("/assets")
     * @Template("ArcticAssetBundle:Asset:assets.html.twig")
     */
    public function assetsAction()
    {
        return array('title' => 'Assets');
    }

    /**
     * @Route("/new_asset")
     * @Template("ArcticAssetBundle:Asset:new_asset.html.twig")
     */
    public function new_assetAction()
    {
        $form = $this->createForm(new AssetType());
        
        return array(   'title' => 'Add new asset',
                        'form'  =>  $form->createView());
    }
}