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
        /*$maria = new Element();
        $maria->setName('Maria');
        $maria->setBirthDate(new \DateTime('1989-12-23'));
        $maria->setSize('200.2');
        $maria->setWeight('250.2');
        $maria->setSex('f');
        $maria->setCoatColor('black');
        $maria->setRole($this->getReference('pouliniere'));
        $maria->setRace($this->getReference('welshs'));
        $manager->persist($maria);

        $enzo = new Element();
        $enzo->setName('Enzo');
        $enzo->setBirthDate(new \DateTime('1990-12-15'));
        $enzo->setSize('220.2');
        $enzo->setWeight('230.5');
        $enzo->setSex('m');
        $enzo->setCoatColor('grey');
        $enzo->setRole($this->getReference('reproducteur'));
        $enzo->setRace($this->getReference('lusitaniens'));
        $manager->persist($enzo);

        $suzanne = new Element();
        $suzanne->setName('Suzanne');
        $suzanne->setBirthDate(new \DateTime('1991-10-23'));
        $suzanne->setSize('240.2');
        $suzanne->setWeight('180.5');
        $suzanne->setSex('f');
        $suzanne->setCoatColor('white');
        $suzanne->setRole($this->getReference('pouliniere'));
        $suzanne->setRace($this->getReference('divers'));
        $suzanne->setMother($maria);
        $suzanne->setFather($enzo);
        $manager->persist($suzanne);

        $uno = new Element();
        $uno->setName('Uno');
        $uno->setBirthDate(new \DateTime('1993-12-24'));
        $uno->setSize('220.2');
        $uno->setWeight('190.5');
        $uno->setSex('m');
        $uno->setCoatColor('grey');
        $uno->setRole($this->getReference('reproducteur'));
        $uno->setRace($this->getReference('lusitaniens'));
        $manager->persist($uno);

        $mireille = new Element();
        $mireille->setName('Mireille');
        $mireille->setBirthDate(new \DateTime('2000-01-14'));
        $mireille->setSize('195.2');
        $mireille->setWeight('230.5');
        $mireille->setSex('f');
        $mireille->setCoatColor('grey');
        $mireille->setRole($this->getReference('pouliniere'));
        $mireille->setRace($this->getReference('welshs'));
        $mireille->setMother($suzanne);
        $mireille->setFather($uno);
        $manager->persist($mireille);
        
        $hector = new Element();
        $hector->setName('Hector');
        $hector->setBirthDate(new \DateTime('2001-01-14'));
        $hector->setSize('198.2');
        $hector->setWeight('240.5');
        $hector->setSex('m');
        $hector->setCoatColor('brown');
        $hector->setRole($this->getReference('reproducteur'));
        $hector->setRace($this->getReference('welshs'));
        $hector->setFather($uno);
        $manager->persist($hector);
        
        $emily = new Element();
        $emily->setName('Emily');
        $emily->setBirthDate(new \DateTime('2002-08-14'));
        $emily->setSize('175.2');
        $emily->setWeight('170.5');
        $emily->setSex('f');
        $emily->setCoatColor('black');
        $emily->setRole($this->getReference('poulain'));
        $emily->setRace($this->getReference('welshs'));
        $manager->persist($emily);        
        
        $mario = new Element();
        $mario->setName('Mario');
        $mario->setBirthDate(new \DateTime('2003-08-14'));
        $mario->setSize('195.2');
        $mario->setWeight('230.5');
        $mario->setSex('m');
        $mario->setCoatColor('grey');
        $mario->setRole($this->getReference('reproducteur'));
        $mario->setRace($this->getReference('lusitaniens'));
        $manager->persist($mario);

        $marc = new Element();
        $marc->setName('Marc');
        $marc->setBirthDate(new \DateTime('2008-05-30'));
        $marc->setSize('195.2');
        $marc->setWeight('230.5');
        $marc->setSex('m');
        $marc->setCoatColor('white');
        $marc->setRole($this->getReference('reproducteur'));
        $marc->setRace($this->getReference('lusitaniens'));
        $manager->persist($marc);

        $eric = new Element();
        $eric->setName('Eric');
        $eric->setBirthDate(new \DateTime('2005-08-14'));
        $eric->setSize('205.2');
        $eric->setWeight('195.5');
        $eric->setSex('m');
        $eric->setCoatColor('black');
        $eric->setRole($this->getReference('poulain'));
        $eric->setRace($this->getReference('welshs'));
        $manager->persist($eric);
        
        $manager->flush();*/
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}