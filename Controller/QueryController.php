<?php

namespace IDCI\GenealogyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QueryController extends Controller
{
    /**
     * @Route("/entity/{id}.{_format}")
     * @Template()
     */
    public function entityAction(Request $request, $id)
    {
        $entity = $this->getDoctrine()
            ->getEntityManager()
            ->find('GenealogyBundle:Element', $id)
        ;

        $format = $request->getRequestFormat();
        if($format == 'json') {
            $response = $this->render(
                'GenealogyBundle:JSON:elements.json.twig',
                array('entities' => array($entity), 'level' => 0)
            );
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else {
            $response = $this->render(
                'GenealogyBundle:XML:elements.xml.twig',
                array('entities' => array($entity), 'level' => 0)
            );
            $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');
        }
        
        return $response;
    }
    
    /**
     * @Route("/entities.{_format}", defaults={"format" = "xml"})
     * @Template()
     */
    public function entitiesAction(Request $request)
    {
        
        $entities = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('GenealogyBundle:Element')
            ->findEntitiesBasedOnRequest($request->query->all())
        ;
        

        $format = $request->getRequestFormat();
        if($format == 'json') {
            $response = $this->render(
                'GenealogyBundle:JSON:elements.json.twig',
                array('entities' => $entities, 'level' => 0)
            );
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else {
            $response = $this->render(
                'GenealogyBundle:XML:elements.xml.twig',
                array('entities' => $entities, 'level' => 0)
            );
            $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');
        }
        
        return $response;
    }
   
    /**
     * @Route("/entity/{id}/children.{_format}/{level}", defaults={"format" = "xml"})
     * @Template()
     */
    public function childrenEntityAction(Request $request /*$id, $level*/)
    {
        $format = $request->getRequestFormat();
        if($format == 'json') {
            $response = $this->render('GenealogyBundle:JSON:elements.json.twig'/*, array('entities' => $entities)*/);
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else {
            $response = $this->render('GenealogyBundle:XML:elements.xml.twig'/*, array('entities' => $entities)*/);
            $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');
        }
        
        return $response;
    }
    
    /**
     * @Route("/entity/{id}/parents.{_format}/{level}", defaults={"level" = 0})
     * @Template()
     */
    public function parentsEntityAction(Request $request, $id, $level)
    {
        $entity = $this->getDoctrine()
            ->getEntityManager()
            ->find('GenealogyBundle:Element', $id)
        ;
        
        $format = $request->getRequestFormat();
        if($format == 'json') {
            $response = $this->render(
                'GenealogyBundle:JSON:elements.json.twig',
                array(
                    'entities'  => array($entity),
                    'level'     => $level
                )
            );
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else {
            $response = $this->render(
                'GenealogyBundle:XML:elements.xml.twig',
                array(
                    'entities'  => array($entity),
                    'level'     => $level
                )
            );
            $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');
        }
        
        return $response;
    }

    public function parentAction($element, $level)
    {
        $level--;
        
        return $this->render('GenealogyBundle:XML:element.xml.twig', array(
            'element'   => $element,
            'level'     => $level
        ));
    }
}
