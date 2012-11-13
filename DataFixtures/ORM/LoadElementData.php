<?php
// src/IDCIBundle/GenealogyBundle/DataFixtures/ORM/LoadElementData.php

namespace IDCI\Bundle\GenealogyBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IDCI\Bundle\GenealogyBundle\Entity\Element;
use IDCI\Bundle\GenealogyBundle\Entity\Role;
use IDCI\Bundle\GenealogyBundle\Entity\Genealogy;

class LoadElementData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /*Roles*/

        $reproducer = new Role();
        $reproducer->setName('reproducer');
        $manager->persist($reproducer);

        $racehorse = new Role();
        $racehorse->setName('racehorse');
        $manager->persist($racehorse);


        /*Elements*/

        $maria = new Element();
        $maria->setName('Maria');
        $maria->setBirthDate(new \DateTime('1989-12-23'));
        $maria->setSize('200.2');
        $maria->setWeight('250.2');
        $maria->setSex('1');
        $maria->setRank('0');
        $maria->setCoatColor('black');
        $maria->addRole($reproducer);
        $manager->persist($maria);

        $enzo = new Element();
        $enzo->setName('Enzo');
        $enzo->setBirthDate(new \DateTime('1990-12-15'));
        $enzo->setSize('220.2');
        $enzo->setWeight('230.5');
        $enzo->setSex('0');
        $enzo->setRank('26');
        $enzo->setCoatColor('grey');
        $enzo->addRole($reproducer);
        $enzo->addRole($racehorse);
        $manager->persist($enzo);

        $suzanne = new Element();
        $suzanne->setName('Suzanne');
        $suzanne->setBirthDate(new \DateTime('1991-10-23'));
        $suzanne->setSize('240.2');
        $suzanne->setWeight('180.5');
        $suzanne->setSex('1');
        $suzanne->setRank('0');
        $suzanne->setCoatColor('white');
        $suzanne->addRole($reproducer);
        $manager->persist($suzanne);

        $uno = new Element();
        $uno->setName('Uno');
        $uno->setBirthDate(new \DateTime('1993-12-24'));
        $uno->setSize('220.2');
        $uno->setWeight('190.5');
        $uno->setSex('0');
        $uno->setRank('6');
        $uno->setCoatColor('grey');
        $uno->addRole($reproducer);
        $uno->addRole($racehorse);
        $manager->persist($uno);

        $mireille = new Element();
        $mireille->setName('Mireille');
        $mireille->setBirthDate(new \DateTime('2000-01-14'));
        $mireille->setSize('195.2');
        $mireille->setWeight('230.5');
        $mireille->setSex('1');
        $mireille->setRank('256');
        $mireille->setCoatColor('grey');
        $mireille->addRole($reproducer);
        $mireille->addRole($racehorse);
        $manager->persist($mireille);
        
        $hector = new Element();
        $hector->setName('Hector');
        $hector->setBirthDate(new \DateTime('2001-01-14'));
        $hector->setSize('198.2');
        $hector->setWeight('240.5');
        $hector->setSex('0');
        $hector->setRank('46');
        $hector->setCoatColor('brown');
        $hector->addRole($reproducer);
        $hector->addRole($racehorse);
        $manager->persist($hector);
        
        $emily = new Element();
        $emily->setName('Emily');
        $emily->setBirthDate(new \DateTime('2002-08-14'));
        $emily->setSize('175.2');
        $emily->setWeight('170.5');
        $emily->setSex('1');
        $emily->setRank('0');
        $emily->setCoatColor('black');
        $emily->addRole($reproducer);
        $manager->persist($emily);        
        
        $mario = new Element();
        $mario->setName('Mario');
        $mario->setBirthDate(new \DateTime('2003-08-14'));
        $mario->setSize('195.2');
        $mario->setWeight('230.5');
        $mario->setSex('0');
        $mario->setRank('2536');
        $mario->setCoatColor('grey');
        $mario->addRole($reproducer);
        $mario->addRole($racehorse);
        $manager->persist($mario);

        $marc = new Element();
        $marc->setName('Marc');
        $marc->setBirthDate(new \DateTime('2008-05-30'));
        $marc->setSize('195.2');
        $marc->setWeight('230.5');
        $marc->setSex('0');
        $marc->setRank('0');
        $marc->setCoatColor('white');
        $marc->addRole($reproducer);
        $manager->persist($marc);

        $eric = new Element();
        $eric->setName('Eric');
        $eric->setBirthDate(new \DateTime('2005-08-14'));
        $eric->setSize('205.2');
        $eric->setWeight('195.5');
        $eric->setSex('0');
        $eric->setRank('202');
        $eric->setCoatColor('black');
        $eric->addRole($reproducer);
        $eric->addRole($racehorse);
        $manager->persist($eric);
        
        /*Genealogies*/
        
        $genealogy1 = new Genealogy();
        $genealogy1->setMother($maria);
        $genealogy1->setFather($enzo);
        $genealogy1->setChild($mireille);
        $manager->persist($genealogy1);
        
        $genealogy2 = new Genealogy();
        $genealogy2->setMother($suzanne);
        $genealogy2->setFather($uno);
        $genealogy2->setChild($hector);
        $manager->persist($genealogy2);
        
        $genealogy3 = new Genealogy();
        $genealogy3->setFather($uno);
        $genealogy3->setMother($maria);
        $genealogy3->setChild($emily);
        $manager->persist($genealogy3);
        
        $genealogy4 = new Genealogy();
        $genealogy4->setMother($mireille);
        $genealogy4->setFather($hector);
        $genealogy4->setChild($mario);
        $manager->persist($genealogy4);
        
        $genealogy5 = new Genealogy();
        $genealogy5->setMother($mireille);
        $genealogy5->setFather($hector);
        $genealogy5->setChild($eric);
        $manager->persist($genealogy5);
        
        $genealogy6 = new Genealogy();
        $genealogy6->setMother($emily);
        $genealogy6->setFather($mario);
        $genealogy6->setChild($marc);
        $manager->persist($genealogy6);
        
        $manager->flush();

    }
}