<?php

/**
 *
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\GenealogyBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ElementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ElementRepository extends EntityRepository
{
   /**
    * extractQueryBuilder
    *
    * @param array $params
    * @return QueryBuilder
    */
   public function extractQueryBuilder($params)
   {
       $qb = $this->createQueryBuilder('e');

       if(isset($params['id'])) {
           $qb
               ->andWhere('e.id = :id')
               ->setParameter('id', $params['id'])
           ;
       }

       if(isset($params['name'])) {
            $qb
               ->andWhere('e.name = :name')
               ->setParameter('name', $params['name'])
            ;
        }

        if(isset($params['race'])) {
            
            if ($params['race'] == 'divers') {
                $qb
                    ->innerJoin('e.race', 'race', 'WITH', $qb->expr()->notIn('race.name', array('welshs', 'lusitaniens')))
                ;
            } else {
                $qb
                    ->innerJoin('e.race', 'race', 'WITH', 'race.name = :race_name')
                    ->setParameter('race_name', $params['race'])
                ;
            }
        }

        if(isset($params['role'])) {
            $qb
                ->innerJoin('e.roles', 'role', 'WITH', 'role.name = :role_name')
                ->setParameter('role_name', $params['role'])
            ;
        }

       return $qb;
   }

   /**
    * extractQuery
    *
    * @param array $params
    * @return Query
    */
   public function extractQuery($params)
   {
       $qb = $this->extractQueryBuilder($params);

       return is_null($qb) ? $qb : $qb->getQuery();
   }

   /**
    * extract
    *
    * @param array $params
    * @return DoctrineCollection
    */
   public function extract($params)
   {
       $q = $this->extractQuery($params);

       return is_null($q) ? array() : $q->getResult();
   }
}
