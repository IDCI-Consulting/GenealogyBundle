<?php

/**
 *
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: GPL
 *
 */

namespace IDCI\Bundle\GenealogyBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use IDCI\Bundle\GenealogyBundle\Entity\Element;

class LoadElementData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $maria = new Element();
        $maria->setName('Maria');
        $maria->setBirthDate(new \DateTime('1989-12-23'));
        $maria->setSize('200.2');
        $maria->setWeight('250.2');
        $maria->setSex('f');
        $maria->setRank('0');
        $maria->setCoatColor('black');
        $maria->addRole($this->getReference('reproducer'));
        $manager->persist($maria);

        $enzo = new Element();
        $enzo->setName('Enzo');
        $enzo->setBirthDate(new \DateTime('1990-12-15'));
        $enzo->setSize('220.2');
        $enzo->setWeight('230.5');
        $enzo->setSex('m');
        $enzo->setRank('26');
        $enzo->setCoatColor('grey');
        $enzo->addRole($this->getReference('reproducer'));
        $enzo->addRole($this->getReference('racehorse'));
        $manager->persist($enzo);

        $suzanne = new Element();
        $suzanne->setName('Suzanne');
        $suzanne->setBirthDate(new \DateTime('1991-10-23'));
        $suzanne->setSize('240.2');
        $suzanne->setWeight('180.5');
        $suzanne->setSex('f');
        $suzanne->setRank('0');
        $suzanne->setCoatColor('white');
        $suzanne->addRole($this->getReference('reproducer'));
        $suzanne->setMother($maria);
        $suzanne->setFather($enzo);
        $manager->persist($suzanne);

        $uno = new Element();
        $uno->setName('Uno');
        $uno->setBirthDate(new \DateTime('1993-12-24'));
        $uno->setSize('220.2');
        $uno->setWeight('190.5');
        $uno->setSex('m');
        $uno->setRank('6');
        $uno->setCoatColor('grey');
        $uno->addRole($this->getReference('reproducer'));
        $uno->addRole($this->getReference('racehorse'));
        $manager->persist($uno);

        $mireille = new Element();
        $mireille->setName('Mireille');
        $mireille->setBirthDate(new \DateTime('2000-01-14'));
        $mireille->setSize('195.2');
        $mireille->setWeight('230.5');
        $mireille->setSex('f');
        $mireille->setRank('256');
        $mireille->setCoatColor('grey');
        $mireille->addRole($this->getReference('reproducer'));
        $mireille->addRole($this->getReference('racehorse'));
        $mireille->setMother($suzanne);
        $mireille->setFather($uno);
        $manager->persist($mireille);
        
        $hector = new Element();
        $hector->setName('Hector');
        $hector->setBirthDate(new \DateTime('2001-01-14'));
        $hector->setSize('198.2');
        $hector->setWeight('240.5');
        $hector->setSex('m');
        $hector->setRank('46');
        $hector->setCoatColor('brown');
        $hector->addRole($this->getReference('reproducer'));
        $hector->addRole($this->getReference('racehorse'));
        $hector->setFather($uno);
        $manager->persist($hector);
        
        $emily = new Element();
        $emily->setName('Emily');
        $emily->setBirthDate(new \DateTime('2002-08-14'));
        $emily->setSize('175.2');
        $emily->setWeight('170.5');
        $emily->setSex('f');
        $emily->setRank('0');
        $emily->setCoatColor('black');
        $emily->addRole($this->getReference('reproducer'));
        $manager->persist($emily);        
        
        $mario = new Element();
        $mario->setName('Mario');
        $mario->setBirthDate(new \DateTime('2003-08-14'));
        $mario->setSize('195.2');
        $mario->setWeight('230.5');
        $mario->setSex('m');
        $mario->setRank('2536');
        $mario->setCoatColor('grey');
        $mario->addRole($this->getReference('reproducer'));
        $mario->addRole($this->getReference('racehorse'));
        $manager->persist($mario);

        $marc = new Element();
        $marc->setName('Marc');
        $marc->setBirthDate(new \DateTime('2008-05-30'));
        $marc->setSize('195.2');
        $marc->setWeight('230.5');
        $marc->setSex('m');
        $marc->setRank('0');
        $marc->setCoatColor('white');
        $marc->addRole($this->getReference('reproducer'));
        $manager->persist($marc);

        $eric = new Element();
        $eric->setName('Eric');
        $eric->setBirthDate(new \DateTime('2005-08-14'));
        $eric->setSize('205.2');
        $eric->setWeight('195.5');
        $eric->setSex('m');
        $eric->setRank('202');
        $eric->setCoatColor('black');
        $eric->addRole($this->getReference('reproducer'));
        $eric->addRole($this->getReference('racehorse'));
        $manager->persist($eric);
        
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
