<?php
/**
 * Created by PhpStorm.
 * User: zaneta
 * Date: 28.09.2017
 * Time: 15:12
 */

namespace PlantBundle\Service;


use AppBundle\Entity\User;
use DateTime;
use PlantBundle\Entity\Plant;

class IsWateredChanger
{
    /**
     * @param User $user
     * @return User
     */
    public function checkIfYouNeedToWaterPlants(User $user)
    {
        $isWateredCheker = new IsWateredCheker();
        foreach ($user->getPlants() as $key => $plant)
        {
            $plant = $this->changeTheRemainingQuantityWatered($plant);
            if ($plant->getIsWatered() && $isWateredCheker->checkIfPlantShouldBeWatered($plant))
            {
                $plant->setIsWatered(false);
            }
            $user->getPlants()[$key] = $plant;

        }
        return $user;
    }

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
        }
        return $plant;
    }
}

