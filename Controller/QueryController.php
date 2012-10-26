<?php

namespace IDCI\Bundle\GenealogyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\GenealogyBundle\Entity\Element;
use IDCI\Bundle\GenealogyBundle\Entity\Genealogy;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QueryController extends Controller
{
    /**
     * @Route("/entity/{id}.{_format}", requirements={"id" = "\d+", "_format" = "xml|json"})
     * @Template()
     */
    public function entityAction(Request $request, $id)
    {
        $element = $this->getDoctrine()
            ->getEntityManager()
            ->find('IDCIGenealogyBundle:Element', $id)
        ;
        
        if(!$element) {
            throw $this->createNotFoundException("No result found");        
        }

        $format = $request->getRequestFormat();
        if($format == 'json') {
            $response = $this->render(
                'IDCIGenealogyBundle:JSON:elements.json.twig',
                array('entities' => array($element), 'level' => 0)
            );
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else if($format == 'xml') {
            $response = $this->render(
                'IDCIGenealogyBundle:XML:elements.xml.twig',
                array('entities' => array($element), 'level' => 0)
            );
            $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');
        }
        
        return $response;
    }
    
    /**
     * @Route("/entities.{_format}", requirements={"_format" = "xml|json"}, defaults={"format" = "xml"})
     * @Template()
     */
    public function entitiesAction(Request $request)
    {
        
        $elements = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('IDCIGenealogyBundle:Element')
            ->findEntitiesBasedOnRequest($request->query->all())
        ;
        
        if(!$elements)
            $this->createNotFoundException("No results found");

        $format = $request->getRequestFormat();
        if($format == 'json') {
            $response = $this->render(
                'IDCIGenealogyBundle:JSON:elements.json.twig',
                array('entities' => $elements, 'level' => 0)
            );
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else if($format == 'xml') {
            $response = $this->render(
                'IDCIGenealogyBundle:XML:elements.xml.twig',
                array('entities' => $elements, 'level' => 0)
            );
            $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');
        }
        
        return $response;
    }
   
    /**
     * @Route("/entity/{id}/children.{_format}/{level}", requirements={"id" = "\d+", "level" = "\d+", "_format" = "xml|json"}, defaults={"level" = 0})
     * @Template()
     */
    public function childrenEntityAction(Request $request, $id, $level)
    {
        $format = $request->getRequestFormat();

        $element = $this->getDoctrine()
            ->getEntityManager()
            ->find('IDCIGenealogyBundle:Element', $id)
        ;
        
        if(!$element) {
            throw $this->createNotFoundException("No result found");        
        }

        if($format == 'json') {
            $response = $this->render(
                    'IDCIGenealogyBundle:JSON:children.json.twig', 
                    array(
                        'entities'  => array($element),
                        'level'     => $level
                    )
            );
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else if($format == 'xml') {
            $response = $this->render(
                    'IDCIGenealogyBundle:XML:children.xml.twig',
                    array(
                        'entities'  => array($element),
                        'level'     => $level
                    )
                    
            );
            $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');
        }

        return $response;
    }

    /**
     * @Route("/entity/{id}/parents.{_format}/{level}", requirements={"id" = "\d+", "level" = "\d+", "_format" = "xml|json"}, defaults={"level" = 0})
     * @Template()
     */
    public function parentsEntityAction(Request $request, $id, $level)
    {
       $element = $this->getDoctrine()
            ->getEntityManager()
            ->find('IDCIGenealogyBundle:Element', $id)
       ;

        if(!$element) {
            throw $this->createNotFoundException("No result found");        
        }
        
        $format = $request->getRequestFormat();
        if($format == 'json') {
            $response = $this->render(
                'IDCIGenealogyBundle:JSON:elements.json.twig',
                array(
                    'entities'  => array($element),
                    'level'     => $level
                )
            );
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else if($format == 'xml') {
            $response = $this->render(
                'IDCIGenealogyBundle:XML:elements.xml.twig',
                array(
                    'entities'  => array($element),
                    'level'     => $level
                )
            );
            $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');
        }
        
        return $response;
    }

    public function jsonParentAction($element, $level)
    {
        $level--;
        
        return $this->render('IDCIGenealogyBundle:JSON:element.json.twig', array(
            'element'   => $element,
            'level'     => $level
        ));
    }
    
    public function xmlParentAction($element, $level)
    {
        $level--;
        
        return $this->render('IDCIGenealogyBundle:XML:element.xml.twig', array(
            'element'   => $element,
            'level'     => $level
        ));
    }
    
    public function jsonChildrenAction($element, $level, $childNumber)
    {
        $level--;

        $id = $element->getId();
        $children = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('IDCIGenealogyBundle:Element')
            ->findChildren($id)
        ;

        $child = $children[$childNumber];
        
        return $this->render('IDCIGenealogyBundle:JSON:child.json.twig', array(
            'element'   => $child,
            'level'      => $level
        ));
    }
    
    public function xmlChildrenAction($element, $level, $childNumber)
    {
        $level--;

        $id = $element->getId();
        $children = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('IDCIGenealogyBundle:Element')
            ->findChildren($id)
        ;

        $child = $children[$childNumber];
        
        return $this->render('IDCIGenealogyBundle:XML:child.xml.twig', array(
            'element'   => $child,
            'level'     => $level
        ));
    }

}
