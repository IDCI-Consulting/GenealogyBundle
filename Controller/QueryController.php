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
        $entity = $this->getDoctrine()
            ->getEntityManager()
            ->find('IDCIGenealogyBundle:Element', $id)
        ;

        $format = $request->getRequestFormat();
        if($format == 'json') {
            $response = $this->render(
                'IDCIGenealogyBundle:JSON:elements.json.twig',
                array('entities' => array($entity), 'level' => 0)
            );
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else if($format == 'xml') {
            $response = $this->render(
                'IDCIGenealogyBundle:XML:elements.xml.twig',
                array('entities' => array($entity), 'level' => 0)
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
        
        $entities = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('IDCIGenealogyBundle:Element')
            ->findEntitiesBasedOnRequest($request->query->all())
        ;
        
        if(!$entities)
            $this->createNotFoundException("No results found");

        $format = $request->getRequestFormat();
        if($format == 'json') {
            $response = $this->render(
                'IDCIGenealogyBundle:JSON:elements.json.twig',
                array('entities' => $entities, 'level' => 0)
            );
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else if($format == 'xml') {
            $response = $this->render(
                'IDCIGenealogyBundle:XML:elements.xml.twig',
                array('entities' => $entities, 'level' => 0)
            );
            $response->headers->set('Content-Type', 'text/xml; charset=UTF-8');
        }
        
        return $response;
    }
   
    /**
     * @Route("/entity/{id}/children.{_format}/{level}", requirements={"id" = "\d+", "level" = "\d+", "_format" = "xml|json"}, defaults={"format" = "xml"})
     * @Template()
     */
    public function childrenEntityAction(Request $request, $id, $level)
    {
        $format = $request->getRequestFormat();
        
        $element = $this->getDoctrine()
            ->getEntityManager()
            ->find('IDCIGenealogyBundle:Element', $id)
        ;
        
        $mothers = $element->getMothers(); //récupère les généalogies dans lesquelles l'élément est une mère

        if(null == $mothers || null == $element) {
            throw $this->createNotFoundException("No result found");        
        }
        
        $children = array();
        foreach($mothers as $mother){
            die("je suis dans le foreach");
            $children[] = $mother->getChild();
        }

        if($format == 'json') {
            $response = $this->render('IDCIGenealogyBundle:JSON:elements.json.twig', array('entities' => $children));
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else if($format == 'xml') {
            $response = $this->render('IDCIGenealogyBundle:XML:elements.xml.twig', array('entities' => $children));
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
       $entity = $this->getDoctrine()
            ->getEntityManager()
            ->find('IDCIGenealogyBundle:Element', $id)
        ;

        if(null == $entity) {
            throw $this->createNotFoundException("No result found");        
        }
        
        $format = $request->getRequestFormat();
        if($format == 'json') {
            $response = $this->render(
                'IDCIGenealogyBundle:JSON:elements.json.twig',
                array(
                    'entities'  => array($entity),
                    'level'     => $level
                )
            );
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        } else if($format == 'xml') {
            $response = $this->render(
                'IDCIGenealogyBundle:XML:elements.xml.twig',
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
        
        return $this->render('IDCIGenealogyBundle:XML:element.xml.twig', array(
            'element'   => $element,
            'level'     => $level
        ));
    }
}
