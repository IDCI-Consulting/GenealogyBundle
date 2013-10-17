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
use IDCI\Bundle\GenealogyBundle\Entity\Role;

class LoadRoleData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /*Roles*/

        $reproducteur = new Role();
        $reproducteur->setName('reproducteur');
        $this->addReference('reproducteur', $reproducteur);
        $manager->persist($reproducteur);

        $pouliniere = new Role();
        $pouliniere->setName('poulinière');
        $this->addReference('pouliniere', $pouliniere);
        $manager->persist($pouliniere);

        $poulain = new Role();
        $poulain->setName('poulain');
        $this->addReference('poulain', $poulain);
        $manager->persist($poulain);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}