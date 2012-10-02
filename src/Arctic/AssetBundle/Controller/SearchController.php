<?php

namespace Arctic\AssetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arctic\AssetBundle\Entity\Asset;
use Arctic\AssetBundle\Form\AssetType;

/**
 * Search controller for assets.
 *
 * @Route("/search")
 */
class SearchController extends Controller
{
    /**
     * Searches for an asset
     *
     * @Route("/", name="asset_search")
     * @Method("POST")
     * @Template()
     */
    public function searchAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('ArcticAssetBundle:Asset')->search($request->request->get('query'));

        if ($request->isXmlHttpRequest()) {
            $response = new Response(json_encode($result));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }

        if (count($result) == 1) {
        	return $this->redirect($this->generateUrl('asset_show', array('id' => $result[0]['id'])));
        }

        return array(
            'assets' => $result,
            'title'	 => 'Search result'	
        );
    }
}