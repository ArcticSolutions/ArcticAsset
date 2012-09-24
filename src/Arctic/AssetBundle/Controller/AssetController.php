<?php

namespace Arctic\AssetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arctic\AssetBundle\Form\AssetType;
use Arctic\AssetBundle\Entity\Asset;

class AssetController extends Controller
{
    /**
     * @Route("/assets")
     * @Template("")
     */
    public function assetsAction()
    {
        $assets = $this->getDoctrine()
            ->getRepository('ArcticAssetBundle:Asset')
            ->findAll();
        return array(   'title' => 'Assets',
                        'assets' => $assets);
    }

    /**
     * @Route("/new_asset")
     * @Template("")
     */
    public function new_assetAction(Request $request)
    {
        $asset = new Asset();

        $form = $this->createForm(new AssetType());

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $asset = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($asset);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Asset with serialnumber ' . $asset->getSerialnumber() . ' was saved');
                return $this->redirect($this->generateUrl('arctic_asset_asset_assets'));
            }
        }
        
        return array(   'title' => 'Add new asset',
                        'form'  =>  $form->createView());
    }
}