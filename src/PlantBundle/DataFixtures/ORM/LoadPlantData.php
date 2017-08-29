<?php

namespace PlantBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PlantBundle\Entity\Plant;
use PlantBundle\Entity\PlantSpecification;

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
         * @var PlantSpecification $plantS
         */
        $user = $this->getReference('flower-user');
        $plantS = $this->getReference('agawa');

        $plant = new Plant();
        $plant->setOwner($user);
        $plant->setPlantSpecification($plantS);
        $plant->setIsWatered(false);
        $manager->persist($plant);

        $plantS = $this->getReference('ficus');

        $plant = new Plant();
        $plant->setOwner($user);
        $plant->setPlantSpecification($plantS);
        $plant->setIsWatered(true);
        $manager->persist($plant);

        $plantS = $this->getReference('mila');

        $plant = new Plant();
        $plant->setOwner($user);
        $plant->setPlantSpecification($plantS);
        $plant->setIsWatered(false);
        $manager->persist($plant);

        $user = $this->getReference('flower_lover-user');

        $plant = new Plant();
        $plant->setOwner($user);
        $plant->setPlantSpecification($plantS);
        $plant->setIsWatered(true);
        $manager->persist($plant);

        $user = $this->getReference('rose_lover-user');
        $plantS = $this->getReference('storczyk');

        $plant = new Plant();
        $plant->setOwner($user);
        $plant->setPlantSpecification($plantS);
        $plant->setIsWatered(false);
        $manager->persist($plant);

        $plantS = $this->getReference('azalia');

        $plant = new Plant();
        $plant->setOwner($user);
        $plant->setPlantSpecification($plantS);
        $plant->setIsWatered(false);
        $manager->persist($plant);

        $user = $this->getReference('sunflower-user');
        $plantS = $this->getReference('asian_basil');

        $plant = new Plant();
        $plant->setOwner($user);
        $plant->setPlantSpecification($plantS);
        $plant->setIsWatered(false);
        $manager->persist($plant);

        $plantS = $this->getReference('osmunda');

        $plant = new Plant();
        $plant->setOwner($user);
        $plant->setPlantSpecification($plantS);
        $plant->setIsWatered(true);
        $manager->persist($plant);

        $plantS = $this->getReference('mila');

        $plant = new Plant();
        $plant->setOwner($user);
        $plant->setPlantSpecification($plantS);
        $plant->setIsWatered(true);
        $manager->persist($plant);

        $plantS = $this->getReference('leptocereus');

        $plant = new Plant();
        $plant->setOwner($user);
        $plant->setPlantSpecification($plantS);
        $plant->setIsWatered(false);
        $manager->persist($plant);

        $user = $this->getReference('flower_sun-user');

        $plant = new Plant();
        $plant->setOwner($user);
        $plant->setPlantSpecification($plantS);
        $plant->setIsWatered(true);
        $manager->persist($plant);

        $manager->flush();
    }
    public function getOrder()
    {
        return 3;
    }
}

