<?php

namespace Tests\PlantBundle\Entity;


use DateTime;
use PHPUnit\Framework\TestCase;
use PlantBundle\Entity\Plant;

class PlantTest extends TestCase
{
    public function testGoodCreatePlant()
    {
        $plant = new Plant();
        $this->assertInstanceOf('PlantBundle\Entity\Plant', $plant);
        $this->assertEquals(false, $plant->getIsDaily());
        $this->assertEquals(true, $plant->getIsWatered());
        $this->assertEquals(0, $plant->getRemaining());
        $this->assertLessThan(new DateTime('now'), $plant->getDateLastWatered());
    }

    public function testSetName()
    {
        $plant = new Plant();
        $plant->setName('Azalia');
        self::assertEquals('Azalia', $plant->getName());
    }

    public function testSetPlace()
    {
        $plant = new Plant();
        $plant->setPlace('Garden');
        self::assertEquals('Garden', $plant->getPlace());
    }

    public function testSetDescription()
    {
        $plant = new Plant();
        $plant->setDescription('Nice flower, watering three onece on day');
        self::assertEquals('Nice flower, watering three onece on day', $plant->getDescription());
    }

    public function testSetDateLastWatered()
    {
        $plant = new Plant();
        $date = new DateTime('now');
        $plant->setDateLastWatered($date);
        self::assertEquals($date, $plant->getDateLastWatered());
    }

    public function testSetAmount()
    {
        $plant = new Plant();
        $plant->setAmount(1.75);
        self::assertEquals(1.75, $plant->getAmount());
    }

    public function testSetFrequency()
    {
        $plant = new Plant();
        $plant->setFrequency(2);
        self::assertEquals(2, $plant->getFrequency());
    }

    public function testSetIsDaily()
    {
        $plant = new Plant();
        $plant->setIsDaily(true);
        self::assertEquals(true, $plant->getIsDaily());
    }

    public function testIsWatered()
    {
        $plant = new Plant();
        $plant->setIsWatered(false);
        self::assertEquals(false, $plant->getIsWatered());
    }

    public function testRemaining()
    {
        $plant = new Plant();
        $plant->setRemaining(2);
        self::assertEquals(2, $plant->getRemaining());
    }

}

