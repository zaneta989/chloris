<?php

namespace PlantBundle\Service;

use AppBundle\Entity\User;
use DateTime;
use PlantBundle\Entity\Plant;

class NotificationRemover
{
    /**
     * @param User $user
     * @param Plant $plant
     * @return User
     */
    public function removeNotafication(User $user, Plant $plant)
    {
        $notificationToRemove = $user->findNotaficationBySubject($plant->getName());
        if($notificationToRemove!=null)
        {
            $user = $user->removeNotification($notificationToRemove);
        }
        return $user;
    }
}

