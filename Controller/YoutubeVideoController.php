<?php

namespace IDCI\Bundle\GenealogyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\GenealogyBundle\Entity\YoutubeVideo;
use IDCI\Bundle\GenealogyBundle\Form\Type\YoutubeVideoType;

/**
 * YoutubeVideo controller.
 *
 * @Route("/video")
 */
class YoutubeVideoController extends Controller
{

    /**
     * Lists all YoutubeVideo entities.
     *
     * @Route("/", name="video")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IDCIGenealogyBundle:YoutubeVideo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new YoutubeVideo entity.
     *
     * @Route("/", name="video_create")
     * @Method("POST")
     * @Template("IDCIGenealogyBundle:YoutubeVideo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new YoutubeVideo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('video_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a YoutubeVideo entity.
    *
    * @param YoutubeVideo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(YoutubeVideo $entity)
    {
        $form = $this->createForm(new YoutubeVideoType(), $entity, array(
            'action' => $this->generateUrl('video_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new YoutubeVideo entity.
     *
     * @Route("/new", name="video_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new YoutubeVideo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a YoutubeVideo entity.
     *
     * @Route("/{id}", name="video_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:YoutubeVideo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find YoutubeVideo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing YoutubeVideo entity.
     *
     * @Route("/{id}/edit", name="video_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:YoutubeVideo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find YoutubeVideo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a YoutubeVideo entity.
    *
    * @param YoutubeVideo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(YoutubeVideo $entity)
    {
        $form = $this->createForm(new YoutubeVideoType(), $entity, array(
            'action' => $this->generateUrl('video_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing YoutubeVideo entity.
     *
     * @Route("/{id}", name="video_update")
     * @Method("PUT")
     * @Template("IDCIGenealogyBundle:YoutubeVideo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:YoutubeVideo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find YoutubeVideo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('video_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a YoutubeVideo entity.
     *
     * @Route("/{id}", name="video_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IDCIGenealogyBundle:YoutubeVideo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find YoutubeVideo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('video'));
    }

    /**
     * Creates a form to delete a YoutubeVideo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('video_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
