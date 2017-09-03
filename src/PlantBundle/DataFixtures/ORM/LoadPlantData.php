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
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var User $user
         */
        $user = $this->getReference('admin-user');

        $plant = new Plant();
        $plant->setName("Azalia");;
        $plant->setDescription("plant naturally occurs in Asia");
        $plant->setFrequency(2);
        $plant->setIsDaily(true);
        $plant->setAmount(0.15);
        $plant->setPlace("Garden");
        $plant->setDateLastWatered(new \DateTime());
        $plant->setOwner($user);
        $manager->persist($plant);

        $plant = new Plant();
        $plant->setName("cactus");;
        $plant->setFrequency(14);
        $plant->setAmount(0.5);
        $plant->setDateLastWatered(new \DateTime());
        $plant->setOwner($user);
        $manager->persist($plant);

        $plant = new Plant();
        $plant->setName("orchidea");;
        $plant->setFrequency(7);
        $plant->setAmount(0.75);
        $plant->setDateLastWatered(new \DateTime());
        $plant->setOwner($user);
        $manager->persist($plant);

        $user = $this->getReference('flower-user');

        $plant = new Plant();
        $plant->setName("cactus");;
        $plant->setFrequency(10);
        $plant->setAmount(0.33);
        $plant->setPlace("shelf");
        $plant->setDateLastWatered(new \DateTime());
        $plant->setOwner($user);
        $manager->persist($plant);

        $plant = new Plant();
        $plant->setName("cactus");;
        $plant->setFrequency(21);
        $plant->setAmount(0.4);
        $plant->setPlace("window");
        $plant->setDateLastWatered(new \DateTime());
        $plant->setOwner($user);
        $manager->persist($plant);

        $user = $this->getReference('flower_sun-user');

        $plant = new Plant();
        $plant->setName("basil");;
        $plant->setFrequency(1);
        $plant->setAmount(0.25);
        $plant->setDescription("watering at the night");
        $plant->setDateLastWatered(new \DateTime());
        $plant->setOwner($user);
        $manager->persist($plant);

        $plant = new Plant();
        $plant->setName("rosemary");;
        $plant->setFrequency(2);
        $plant->setAmount(0.2);
        $plant->setPlace("window");
        $plant->setDateLastWatered(new \DateTime());
        $plant->setOwner($user);
        $manager->persist($plant);

        $user = $this->getReference('test_user-user');

        $plant = new Plant();
        $plant->setName("fern");;
        $plant->setFrequency(3);
        $plant->setAmount(0.25);
        $plant->setDateLastWatered(new \DateTime());
        $plant->setOwner($user);
        $manager->persist($plant);

        $manager->flush();

    }
    public function getOrder()
    {
        return 2;
    }
}

