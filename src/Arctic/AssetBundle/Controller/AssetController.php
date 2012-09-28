<?php

namespace Arctic\AssetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arctic\AssetBundle\Entity\Asset;
use Arctic\AssetBundle\Form\AssetType;

/**
 * Asset controller.
 *
 * @Route("/asset")
 */
class AssetController extends Controller
{
    /**
     * Lists all Asset entities.
     *
     * @Route("/", name="asset")
     * @Route("/category/{categoryId}", name="asset_by_category", requirements={"categoryId" = "\d+"})
     * @Template()
     */
    public function assetsAction($categoryId = null)
    {
        $em = $this->getDoctrine()->getManager();

        $assets = $em->getRepository('ArcticAssetBundle:Asset')->getAssetsForListView($categoryId);
        $assetsByCategory = $em->getRepository('ArcticAssetBundle:Asset')->getCountOfAssetssInCategory();
        $assetsTotal = $em->getRepository('ArcticAssetBundle:Asset')->getCountOfAssets();

        return array(
            'title'                 => 'Assets',
            'assets'                => $assets,
            'assetsByCategory'      => $assetsByCategory,
            'assetsTotal'           => $assetsTotal,
            'selectedCategory'      => $categoryId
        );
    }

    /**
     * Finds and displays a Asset entity.
     *
     * @Route("/{id}/show", name="asset_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArcticAssetBundle:Asset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Asset entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'title'       => 'Asset ' . $entity->getSerialnumber(),
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Asset entity.
     *
     * @Route("/new", name="asset_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Asset();
        $form   = $this->createForm(new AssetType(), $entity);

        return array(
            'title'  => 'New asset',
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Asset entity.
     *
     * @Route("/create", name="asset_create")
     * @Method("POST")
     * @Template("ArcticAssetBundle:Asset:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Asset();
        $form = $this->createForm(new AssetType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Asset with serialnumber ' . $entity->getSerialnumber() . ' was created');
            return $this->redirect($this->generateUrl('asset_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Asset entity.
     *
     * @Route("/{id}/edit", name="asset_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArcticAssetBundle:Asset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Asset entity.');
        }

        $editForm = $this->createForm(new AssetType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'title'       => 'Edit asset ' . $entity->getSerialnumber(),
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Asset entity.
     *
     * @Route("/{id}/update", name="asset_update")
     * @Method("POST")
     * @Template("ArcticAssetBundle:Asset:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->getAsset($id);

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AssetType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $this->persistAsset($entity);
            return $this->redirect($this->generateUrl('asset_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Updates an Asset from the a Ticket
     *
     * @Route("/{assetId}/update_from_ticket/{ticketId}", name="asset_update_from_ticket")
     * @Method("POST")
     * @Template()
     */
    public function updateFromTicketAction(Request $request, $assetId, $ticketId)
    {
        $entity = $this->getAsset($assetId);

        $editForm = $this->createForm(new AssetType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $this->persistAsset($entity);
        }

        return $this->redirect($this->generateUrl('ticket_show', array('id' => $ticketId)));
    }

    /**
     * Deletes a Asset entity.
     *
     * @Route("/{id}/delete", name="asset_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ArcticAssetBundle:Asset')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Asset entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        $this->get('session')->getFlashBag()->add('success', 'Asset with serialnumber ' . $entity->getSerialnumber() . ' was deleted');
        return $this->redirect($this->generateUrl('asset'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Saved an asset to the database and adds a flash massage
     * 
     * @param Asset $asset Asset to be saved
     */
    private function persistAsset(Asset $asset)
    {
        $em = $this->getDoctrine()->getManager();

        $em->persist($asset);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Changes to asset with serialnumber ' . $asset->getSerialnumber() . ' was saved');
    }

    /**
     * Find and returns an asset based on an id
     *
     * @param integer $id Id of asset to get
     * @return Asset
     */
    private function getAsset($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArcticAssetBundle:Asset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Asset entity.');
        }

        return $entity;
    }
}
