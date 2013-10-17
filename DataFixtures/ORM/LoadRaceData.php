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
use IDCI\Bundle\GenealogyBundle\Entity\Race;

class LoadRaceData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /*Roles*/

        $welshs = new Race();
        $welshs->setName('Welshs');
        $this->addReference('welshs', $welshs);
        $manager->persist($welshs);

        $lusitaniens = new Race();
        $lusitaniens->setName('Lusitaniens');
        $this->addReference('lusitaniens', $lusitaniens);
        $manager->persist($lusitaniens);

        $divers = new Race();
        $divers->setName('Divers');
        $this->addReference('divers', $divers);
        $manager->persist($divers);

        $manager->flush();

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}