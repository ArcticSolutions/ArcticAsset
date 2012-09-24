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
     * @Template()
     */
    public function assetsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ArcticAssetBundle:Asset')->findAll();

        return array(
            'title'       => 'Assets',
            'entities' => $entities,
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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ArcticAssetBundle:Asset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Asset entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AssetType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Changes to asset with serialnumber ' . $entity->getSerialnumber() . ' was saved');
            return $this->redirect($this->generateUrl('asset_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
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
}
