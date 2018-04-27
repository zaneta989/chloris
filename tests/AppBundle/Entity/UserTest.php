<?php

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\User;
use AppBundle\Entity\UserPreferences;
use PHPUnit\Framework\TestCase;
use PlantBundle\Entity\Plant;

class UserTest extends TestCase
{
    public function testAddPlants()
    {
        $user = new User();

        $this->assertEmpty($user->getPlants());

        $plant = new Plant();

        $user->addPlant($plant);
        $this->assertContains($plant, $user->getPlants());

        $user->addPlant(new Plant());
        $user->addPlant(new Plant());
        $user->addPlant(new Plant());
        $user->addPlant(new Plant());

        $this->assertCount(5, $user->getPlants());
    }

    public function testUserPreferences()
    {
        $user = new User();

        $this->assertEquals('en', $user->getPreferences()->getLocale());
        $this->assertEquals('tableView', $user->getPreferences()->getView());

    }

    public function testSetUserPreferences()
    {
        $user = new User();

        $preferences = new UserPreferences();

        $preferences->setLocale('pl');
        $preferences->setView('cardView');

        $user->setPreferences($preferences);

        $this->assertEquals($preferences, $user->getPreferences());
    }
}

