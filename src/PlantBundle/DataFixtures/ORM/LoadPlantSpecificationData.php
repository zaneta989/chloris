<?php

namespace PlantBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PlantBundle\Entity\PlantSpecification;

class LoadPlantSpecificationData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = $this->getReference('admin-user');

        $plantS = new PlantSpecification();
        $plantS->setName("Azalia");
        $plantS -> setLatinName("Rhododendron");
        $plantS -> setDescription("Plant naturally occurs in Asia");
        $plantS->setFrequency(1);
        $plantS->setFrequencyDays(2);
        $plantS->setAmount(1.25);
        $plantS->setPlace("Garden");
        $plantS->setAuthor($user);
        $manager->persist($plantS);

        $plantS = new PlantSpecification();
        $plantS->setName("Storczyk");
        $plantS -> setLatinName("Orchidaceae");
        $plantS->setFrequency(1);
        $plantS->setFrequencyDays(7);
        $plantS->setAmount(2);
        $plantS->setPlace("Sunny");
        $plantS->setAuthor($user);
        $manager->persist($plantS);

        $plantS = new PlantSpecification();
        $plantS->setName("Mila");
        $plantS -> setLatinName("Mila caespitosa Britton & Rose");
        $plantS->setFrequency(1);
        $plantS->setFrequencyDays(14);
        $plantS->setAmount(0.25);
        $plantS->setPlace("not sunny");
        $plantS->setAuthor($user);
        $manager->persist($plantS);

        $plantS = new PlantSpecification();
        $plantS->setName("Leptocereus");
        $plantS -> setLatinName("Leptocereus (A.Berger) Britton & Rose");
        $plantS -> setDescription("Plant naturally occurs in Caribbean islands");
        $plantS->setFrequency(1);
        $plantS->setFrequencyDays(10);
        $plantS->setAmount(0.5);
        $plantS->setPlace("Garden");
        $plantS->setAuthor($user);
        $manager->persist($plantS);


        $user = $this->getReference('flower-user');

        $plantS = new PlantSpecification();
        $plantS->setName("Ficus benjamin");
        $plantS -> setDescription("It is the official tree of Bangkok.");
        $plantS->setFrequency(1);
        $plantS->setFrequencyDays(4);
        $plantS->setAmount(1.25);
        $plantS->setPlace("not sunny");
        $plantS->setAuthor($user);
        $manager->persist($plantS);

        $user = $this->getReference('flower_lover-user');

        $plantS = new PlantSpecification();
        $plantS->setName("Asian basil");
        $plantS -> setLatinName("Ocimum tenuiflorum");
        $plantS -> setDescription("Plant naturally occurs in Asia");
        $plantS->setFrequency(1);
        $plantS->setFrequencyDays(1);
        $plantS->setAmount(0.3);
        $plantS->setAuthor($user);
        $manager->persist($plantS);

        $user = $this->getReference('rose_lover-user');

        $plantS = new PlantSpecification();
        $plantS->setName("Agawa potatorum");
        $plantS->setFrequency(1);
        $plantS->setFrequencyDays(7);
        $plantS->setAmount(0.25);
        $plantS->setAuthor($user);
        $manager->persist($plantS);

        $plantS = new PlantSpecification();
        $plantS->setName("Osmunda japonica");
        $plantS->setFrequency(1);
        $plantS->setFrequencyDays(3);
        $plantS->setAmount(1.25);
        $plantS->setPlace("Garden");
        $plantS->setAuthor($user);
        $manager->persist($plantS);

        $manager->flush();
    }
    public function getOrder()
    {
        return 2;
    }
}

