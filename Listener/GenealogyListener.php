<?php 

namespace IDCI\Bundle\GenealogyBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use IDCI\Bundle\GenealogyBundle\Entity\Genealogy;

class GenealogyListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof Genealogy) {
            $childId = $entity->getChild()->getId();           
            $element = $entityManager->find('IDCIGenealogyBundle:Element', $childId);
            $element->setGenealogy($entity);        
            $entityManager->persist($element);
            $entityManager->flush();
        }
    }
}