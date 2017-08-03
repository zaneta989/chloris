<?php

use AppBundle\DataFixtures\ORM\LoadUserData;
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class FeatureContext extends MinkContext implements Context
{
    use KernelDictionary;

    public function __construct()
    {
    }
    /**
     * @AfterScenario @database
     */
    public function loadDataFixtures()
    {
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');

        $loader = new Loader();
        $loader->addFixture(new LoadUserData());

        $purger = new ORMPurger();
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);

        $executor = new ORMExecutor($entityManager, $purger);
        $executor->execute($loader->getFixtures());
    }

}
