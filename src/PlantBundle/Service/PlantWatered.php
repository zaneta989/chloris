<?php

namespace PlantBundle\Service;

use DateTime;
use PlantBundle\Entity\Plant;

class PlantWatered
{
    /**
     * @param Plant $plant
     * @return bool
     */
    public function checkIfCouldWateredPlant(Plant $plant)
    {
        return $plant->getRemaining() > 0;
    }

    /**
     * @param Plant $plant
     * @return Plant
     */
    public function wateringPlant(Plant $plant)
    {
        return $plant
            ->setDateLastWatered(new DateTime('now'))
            ->setRemaining($plant->getRemaining()-1)
            ->setIsWatered(true);
    }
}

