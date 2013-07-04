<?php

/**
 *
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\GenealogyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\GenealogyBundle\Entity\Element;
use IDCI\Bundle\GenealogyBundle\Form\ElementType;

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
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IDCIGenealogyBundle:Element')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Element entity.
     *
     * @Route("/{id}/show", name="element_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Element')->find($id);

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
     * Displays a form to create a new Element entity.
     *
     * @Route("/new", name="element_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Element();
        $form   = $this->createForm(new ElementType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Element entity.
     *
     * @Route("/create", name="element_create")
     * @Method("POST")
     * @Template("IDCIGenealogyBundle:Element:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Element();
        $form = $this->createForm(new ElementType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been created', array(
                    '%entity%' => 'Element',
                    '%id%'     => $entity->getId()
                ))
            );

            return $this->redirect($this->generateUrl('element_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Element entity.
     *
     * @Route("/{id}/edit", name="element_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Element')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Element entity.');
        }

        $editForm = $this->createForm(new ElementType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Element entity.
     *
     * @Route("/{id}/update", name="element_update")
     * @Method("POST")
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
        $editForm = $this->createForm(new ElementType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

        $this->get('session')->getFlashBag()->add(
            'info',
            $this->get('translator')->trans('%entity%[%id%] has been updated', array(
                '%entity%' => 'Element',
                '%id%'     => $entity->getId()
            ))
        );

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
     * @Route("/{id}/delete", name="element_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IDCIGenealogyBundle:Element')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Element entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been deleted', array(
                    '%entity%' => 'Element',
                    '%id%'     => $id
                ))
            );
        }

        return $this->redirect($this->generateUrl('element'));
    }
    
    /**
     * Display Element deleteForm.
     *
     * @Template()
     */
    public function deleteFormAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Element')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Element entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
