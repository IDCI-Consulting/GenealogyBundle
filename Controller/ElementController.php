<?php

namespace IDCI\Bundle\GenealogyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\GenealogyBundle\Form\Type\ElementType;
use IDCI\Bundle\GenealogyBundle\Entity\Element;

/**
 * Element controller.
 *
 * @Route("/element")
 */
class ElementController extends Controller
{
    /**
     * Lists all Element entities.
     *
     * @Route("/", name="element")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('IDCIGenealogyBundle:Element')->findBy(
            array(),
            array('name' => 'asc')
        );

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Element entity.
     *
     * @Route("/", name="element_create")
     * @Method("POST")
     * @Template("IDCIGenealogyBundle:Element:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Element();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('element_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Element entity.
    *
    * @param Element $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm($entity)
    {
        $form = $this->createForm(
            new ElementType(),
            $entity,
            array(
                'action' => $this->generateUrl('element_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Element entity.
     *
     * @Route("/new", name="element_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Element();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Element entity.
     *
     * @Route("/{id}", name="element_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Element')->findOneById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Element entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Element entity.
     *
     * @Route("/{id}/edit", name="element_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Element')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Element entity.');
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
    * Creates a form to edit a Element entity.
    *
    * @param Element $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm($entity)
    {
        $form = $this->createForm(new ElementType(), $entity, array(
            'action' => $this->generateUrl('element_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Element entity.
     *
     * @Route("/{id}", name="element_update")
     * @Method("PUT")
     * @Template("IDCIGenealogyBundle:Element:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Element')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Element entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('element_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Element entity.
     *
     * @Route("/{id}", name="element_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IDCIGenealogyBundle:Element')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Element entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('element'));
    }

    /**
     * Creates a form to delete a Element entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('element_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
