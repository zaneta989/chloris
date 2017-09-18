<?php

namespace PlantBundle\Service;

use DateTime;
use PlantBundle\Entity\Plant;

class NotificationChecker
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

    /**
     * @param Plant $plant
     * @return bool
     */
    public function checkIfNotificationShouldPop(Plant $plant)
    {
        $today = new DateTime('now');
        $today = $today->setTime(0,0,0);
        $isNotificationSend = $plant->getIsNotificationSend();

        if (!$plant->getIsDaily()) {
            return $this->designateTheNextWateringDay($plant) <= $today && !$isNotificationSend;
        } else {
            return  $plant->getRemaining() > 0 && !$isNotificationSend;
        }
    }
}
