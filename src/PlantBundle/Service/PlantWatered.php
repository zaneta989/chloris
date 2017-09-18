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
    public function checkIfCouldChangeRemainingQuantityWatered(Plant $plant)
    {
        $today = new DateTime('now');
        $today = $today->setTime(0, 0, 0);
        $dateLastWatered = $plant->getDateLastWatered()->setTime(0, 0, 0);

        return $today > $dateLastWatered;
    }

    /**
     * @param Plant $plant
     * @return Plant
     */
    public function changeTheRemainingQuantityWatered(Plant $plant)
    {
        if($this->checkIfCouldChangeRemainingQuantityWatered($plant))
        {
            if ($plant->getIsDaily())
            {
                $plant->setRemaining($plant->getFrequency());
            }
            else
            {
                $plant->setRemaining(1);
            }
            $plant->setIsNotificationSend(false);
        }
        return $plant;
    }

    /**
     * @param Plant $plant
     * @return bool
     */
    public function checkIfCouldWateredPlant(Plant $plant)
    {
        $plant = $this->changeTheRemainingQuantityWatered($plant);
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
            ->setIsNotificationSend(false);
    }
}

