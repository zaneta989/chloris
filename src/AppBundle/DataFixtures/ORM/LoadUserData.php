<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@chloris.dev');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_ADMIN'));

        $manager->persist($user);
        $this->addReference('admin-user', $user);

        $user = new User();
        $user->setUsername('sunflower_lover');
        $user->setEmail('sunflower_lover@chloris.dev');
        $user->setPlainPassword('sunflower1234');
        $user->setEnabled(true);

        $manager->persist($user);
        $this->addReference('sunflower-user', $user);

        $user = new User();
        $user->setUsername('flower_lover');
        $user->setEmail('flower_lover@chloris.dev');
        $user->setPlainPassword('flower1234');
        $user->setEnabled(true);

        $manager->persist($user);
        $this->addReference('flower_lover-user', $user);

        $user = new User();
        $user->setUsername('flower');
        $user->setEmail('flower@chloris.dev');
        $user->setPlainPassword('flower1234');
        $user->setEnabled(true);

        $manager->persist($user);
        $this->addReference('flower-user', $user);

        $user = new User();
        $user->setUsername('flower_1');
        $user->setEmail('flower_1@chloris.dev');
        $user->setPlainPassword('flower1234');
        $user->setEnabled(true);

        $manager->persist($user);
        $this->addReference('flower_1-user', $user);

        $user = new User();
        $user->setUsername('test');
        $user->setEmail('test@chloris.dev');
        $user->setPlainPassword('test');
        $user->setEnabled(true);

        $manager->persist($user);
        $this->addReference('test-user', $user);

        $user = new User();
        $user->setUsername('flower_sun');
        $user->setEmail('flower_sun@chloris.dev');
        $user->setPlainPassword('flower1234');
        $user->setEnabled(true);

        $manager->persist($user);
        $this->addReference('flower_sun-user', $user);

        $user = new User();
        $user->setUsername('test_user');
        $user->setEmail('test_user@chloris.dev');
        $user->setPlainPassword('test');
        $user->setEnabled(true);

        $manager->persist($user);
        $this->addReference('test_user-user', $user);

        $user = new User();
        $user->setUsername('plant_lover');
        $user->setEmail('plant_lover@chloris.dev');
        $user->setPlainPassword('plant1234');
        $user->setEnabled(true);

        $manager->persist($user);
        $this->addReference('plant_lover-user', $user);

        $user = new User();
        $user->setUsername('rose_lover');
        $user->setEmail('rose_lover@chloris.dev');
        $user->setPlainPassword('rose1234');
        $user->setEnabled(true);

        $manager->persist($user);
        $this->addReference('rose_lover-user', $user);

        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}

