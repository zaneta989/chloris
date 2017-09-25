<?php

namespace PlantBundle\Service;

use PlantBundle\Entity\Notification;
use AppBundle\Entity\User;

class NotificationSender
{
    /**
     * @param User $user
     * @return User
     */
    public function sendNotification(User $user)
    {
        $notification = new NotificationChecker();

        foreach ($user->getPlants() as $key => $plant)
        {
            if ($notification->checkIfNotificationShouldPop($plant)) {
                if ($plant->getIsDaily()) {
                    $user->addNotification(new Notification(
                        $plant->getName(),
                        'Today You should water '.$plant->getName().' '. $plant->getRemaining().' times a day'
                    ));
                }
                else
                {
                    $user->addNotification(new Notification(
                        $plant->getName(),
                        'Today You should water '.$plant->getName()
                    ));
                }

                $user->getPlants()[$key] = $plant->setIsNotificationSend(true);
            }
        }

        return $user;
    }
}
