<?php

namespace IDCI\Bundle\GenealogyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\GenealogyBundle\Entity\Genealogy;
use IDCI\Bundle\GenealogyBundle\Form\GenealogyType;

/**
 * Genealogy controller.
 *
 * @Route("/genealogy")
 */
class GenealogyController extends Controller
{
    /**
     * Lists all Genealogy entities.
     *
     * @Route("/", name="genealogy")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IDCIGenealogyBundle:Genealogy')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Genealogy entity.
     *
     * @Route("/{id}/show", name="genealogy_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Genealogy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genealogy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Genealogy entity.
     *
     * @Route("/new", name="genealogy_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Genealogy();
        $form   = $this->createForm(new GenealogyType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Genealogy entity.
     *
     * @Route("/create", name="genealogy_create")
     * @Method("POST")
     * @Template("IDCIGenealogyBundle:Genealogy:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Genealogy();
        $form = $this->createForm(new GenealogyType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been created', array(
                    '%entity%' => 'Genealogy',
                    '%id%'     => $entity->getId()
                ))
            );

            return $this->redirect($this->generateUrl('genealogy_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Genealogy entity.
     *
     * @Route("/{id}/edit", name="genealogy_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Genealogy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genealogy entity.');
        }

        $editForm = $this->createForm(new GenealogyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Genealogy entity.
     *
     * @Route("/{id}/update", name="genealogy_update")
     * @Method("POST")
     * @Template("IDCIGenealogyBundle:Genealogy:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Genealogy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genealogy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new GenealogyType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

        $this->get('session')->getFlashBag()->add(
            'info',
            $this->get('translator')->trans('%entity%[%id%] has been updated', array(
                '%entity%' => 'Genealogy',
                '%id%'     => $entity->getId()
            ))
        );

        return $this->redirect($this->generateUrl('genealogy_edit', array('id' => $id)));
        
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Genealogy entity.
     *
     * @Route("/{id}/delete", name="genealogy_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IDCIGenealogyBundle:Genealogy')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Genealogy entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been deleted', array(
                    '%entity%' => 'Genealogy',
                    '%id%'     => $id
                ))
            );
        }

        return $this->redirect($this->generateUrl('genealogy'));
    }
    
    /**
     * Display Genealogy deleteForm.
     *
     * @Template()
     */
    public function deleteFormAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCIGenealogyBundle:Genealogy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genealogy entity.');
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
