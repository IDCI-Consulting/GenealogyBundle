<?php

namespace IDCI\Bundle\GenealogyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\GenealogyBundle\Entity\Role;
use IDCI\Bundle\GenealogyBundle\Form\RoleType;

/**
 * Role controller.
 *
 * @Route("/role")
 */
class RoleController extends Controller
{
    /**
     * Lists all Role entities.
     *
     * @Route("/", name="role")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IDCIGenealogyBundle:Role')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Role entity.
     *
     * @Route("/{id}/show", name="role_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Role')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Role entity.
     *
     * @Route("/new", name="role_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Role();
        $form   = $this->createForm(new RoleType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Role entity.
     *
     * @Route("/create", name="role_create")
     * @Method("POST")
     * @Template("IDCIGenealogyBundle:Role:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Role();
        $form = $this->createForm(new RoleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been created', array(
                    '%entity%' => 'Role',
                    '%id%'     => $entity->getId()
                ))
            );

            return $this->redirect($this->generateUrl('role_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Role entity.
     *
     * @Route("/{id}/edit", name="role_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Role')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }

        $editForm = $this->createForm(new RoleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Role entity.
     *
     * @Route("/{id}/update", name="role_update")
     * @Method("POST")
     * @Template("IDCIGenealogyBundle:Role:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Role')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RoleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

        $this->get('session')->getFlashBag()->add(
            'info',
            $this->get('translator')->trans('%entity%[%id%] has been updated', array(
                '%entity%' => 'Role',
                '%id%'     => $entity->getId()
            ))
        );

        return $this->redirect($this->generateUrl('role_edit', array('id' => $id)));
        
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Role entity.
     *
     * @Route("/{id}/delete", name="role_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IDCIGenealogyBundle:Role')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Role entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been deleted', array(
                    '%entity%' => 'Role',
                    '%id%'     => $id
                ))
            );
        }

        return $this->redirect($this->generateUrl('role'));
    }
    
    /**
     * Display Role deleteForm.
     *
     * @Template()
     */
    public function deleteFormAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Role')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Role entity.');
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
