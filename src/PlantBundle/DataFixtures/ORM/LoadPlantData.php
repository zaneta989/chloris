<?php

namespace PlantBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PlantBundle\Entity\Plant;

class LoadPlantData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var User $user
         */
        $user = $this->getReference('admin-user');
        $plant = new Plant();
        $plant
            ->setName('Azalia')
            ->setDescription('plant naturally occurs in Asia')
            ->setFrequency(2)
            ->setIsDaily(true)
            ->setAmount(0.15)
            ->setPlace('Garden')
            ->setOwner($user);
        $manager->persist($plant);

        $plant = new Plant();
        $plant
            ->setName('cactus')
            ->setFrequency(14)
            ->setAmount(0.5)
            ->setOwner($user);
        $dayLastWatered = $plant
            ->getDateLastWatered()
            ->sub(date_interval_create_from_date_string($plant->getFrequency() . ' days'));
        $plant->setDateLastWatered($dayLastWatered);
        $manager->persist($plant);

        $plant = new Plant();
        $plant
            ->setName('orchidea')
            ->setFrequency(7)
            ->setAmount(0.75)
            ->setOwner($user);
        $manager->persist($plant);

        $dayLastWatered = $plant
            ->getDateLastWatered()
            ->sub(date_interval_create_from_date_string($plant->getFrequency()-1 . ' days'));
        $plant->setDateLastWatered($dayLastWatered);
        $manager->persist($plant);

        $plant = new Plant();
        $plant
            ->setName('rosemary')
            ->setFrequency(2)
            ->setAmount(0.2)
            ->setPlace('window')
            ->setOwner($user);
        $dayLastWatered = $plant
            ->getDateLastWatered()
            ->sub(date_interval_create_from_date_string($plant->getFrequency()+1 . ' days'));
        $plant->setDateLastWatered($dayLastWatered);
        $manager->persist($plant);

        $plant = new Plant();
        $plant
            ->setName('fern')
            ->setFrequency(3)
            ->setAmount(0.25)
            ->setOwner($user);
        $manager->persist($plant);

        $user = $this->getReference('flower-user');
        $plant = new Plant();
        $plant
            ->setName('cactus')
            ->setFrequency(10)
            ->setAmount(0.33)
            ->setPlace('shelf')
            ->setOwner($user);
        $manager->persist($plant);

        $plant = new Plant();
        $plant
            ->setName('cactus')
            ->setFrequency(21)
            ->setAmount(0.4)
            ->setPlace('window')
            ->setOwner($user);
        $manager->persist($plant);

        $user = $this->getReference('flower_sun-user');
        $plant = new Plant();
        $plant
            ->setName('basil')
            ->setFrequency(1)
            ->setAmount(0.25)
            ->setDescription('watering at the night')
            ->setOwner($user);
        $manager->persist($plant);

        $plant = new Plant();
        $plant
            ->setName('rosemary')
            ->setFrequency(2)
            ->setAmount(0.2)
            ->setPlace('window')
            ->setOwner($user);
        $manager->persist($plant);

        $user = $this->getReference('test_user-user');
        $plant = new Plant();
        $plant
            ->setName('fern')
            ->setFrequency(3)
            ->setAmount(0.25)
            ->setOwner($user);
        $manager->persist($plant);

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }
}
