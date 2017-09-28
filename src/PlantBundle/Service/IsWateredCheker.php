<?php

namespace PlantBundle\Service;

use DateTime;
use PlantBundle\Entity\Plant;

class IsWateredCheker
{
    /**
     * @param Plant $plant
     * @return DateTime
     */
    public function designateTheNextWateringDay(Plant $plant)
    {
        $dayNextWatered = new DateTime(date('Y-m-d', $plant->getDateLastWatered()->getTimestamp()));
        $dayNextWatered = $dayNextWatered
            ->add(date_interval_create_from_date_string($plant->getFrequency() . ' days'));
        $dayNextWatered = $dayNextWatered->setTime(0, 0, 0);

        return $dayNextWatered;
    }

    public function isAnHourOfWatering(Plant $plant)
    {
        $now = new DateTime("now");
        $currentTime = date("H", $now->getTimestamp());
        if($plant->getFrequency() == 2)
        {
            if ($plant->getRemaining() == 2 && $currentTime >= 10)
            {
                return true;
            }
            elseif ($plant->getRemaining() == 1 && $currentTime >= 20)
            {
                return true;
            }
        }
        elseif($plant->getFrequency() == 3)
        {
            if ($plant->getRemaining() == 3 && $currentTime >= 10)
            {
                return true;
            }
            elseif ($plant->getRemaining() == 2 && $currentTime >= 15)
            {
                return true;
            }
            elseif ($plant->getRemaining() == 1 && $currentTime >= 20)
            {
                return true;
            }
        }
        elseif($plant->getFrequency() == 4)
        {
            if ($plant->getRemaining() == 4 && $currentTime >= 10)
            {
                return true;
            }
            elseif ($plant->getRemaining() == 3 && $currentTime >= 13)
            {
                return true;
            }
            elseif ($plant->getRemaining() == 2 && $currentTime >= 16)
            {
                return true;
            }
            elseif ($plant->getRemaining() == 1 && $currentTime >= 19)
            {
                return true;
            }
        }
        elseif($plant->getFrequency() == 5)
        {
            if ($plant->getRemaining() == 5 && $currentTime >= 10)
            {
                return true;
            }
            elseif ($plant->getRemaining() == 4 && $currentTime >= 12)
            {
                return true;
            }
            elseif ($plant->getRemaining() == 3 && $currentTime >= 14)
            {
                return true;
            }
            elseif ($plant->getRemaining() == 2 && $currentTime >= 16)
            {
                return true;
            }
            elseif ($plant->getRemaining() == 1 && $currentTime >= 18)
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Plant $plant
     * @return bool
     */
    public function checkIfPlantShouldBeWatered(Plant $plant)
    {
        $today = new DateTime('now');
        $today = $today->setTime(0,0,0);

        if (!$plant->getIsDaily())
        {
            return $this->designateTheNextWateringDay($plant) <= $today;
        }
        else
        {
            return $this->isAnHourOfWatering($plant);
        }
    }
}
