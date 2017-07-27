<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
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

        $user = new User();
        $user->setUsername('sunflower_lover');
        $user->setEmail('sunflower_lover@chloris.dev');
        $user->setPlainPassword('sunflower1234');
        $user->setEnabled(true);

        $manager->persist($user);

        $user = new User();
        $user->setUsername('flower_lover');
        $user->setEmail('flower_lover@chloris.dev');
        $user->setPlainPassword('flower1234');
        $user->setEnabled(true);

        $manager->persist($user);

        $user = new User();
        $user->setUsername('flower');
        $user->setEmail('flower@chloris.dev');
        $user->setPlainPassword('flower1234');
        $user->setEnabled(true);

        $manager->persist($user);

        $user = new User();
        $user->setUsername('flower_1');
        $user->setEmail('flower_1@chloris.dev');
        $user->setPlainPassword('flower1234');
        $user->setEnabled(true);

        $manager->persist($user);

        $user = new User();
        $user->setUsername('test');
        $user->setEmail('test@chloris.dev');
        $user->setPlainPassword('test');
        $user->setEnabled(true);

        $manager->persist($user);

        $user = new User();
        $user->setUsername('flower_sun');
        $user->setEmail('flower_sun@chloris.dev');
        $user->setPlainPassword('flower1234');
        $user->setEnabled(true);

        $manager->persist($user);

        $user = new User();
        $user->setUsername('test_user');
        $user->setEmail('test_user@chloris.dev');
        $user->setPlainPassword('test');
        $user->setEnabled(true);

        $manager->persist($user);

        $user = new User();
        $user->setUsername('plant_lover');
        $user->setEmail('plant_lover@chloris.dev');
        $user->setPlainPassword('plant1234');
        $user->setEnabled(true);

        $manager->persist($user);

        $user = new User();
        $user->setUsername('rose_lover');
        $user->setEmail('rose_lover@chloris.dev');
        $user->setPlainPassword('rose1234');
        $user->setEnabled(true);

        $manager->persist($user);

        $manager->flush();
    }
}