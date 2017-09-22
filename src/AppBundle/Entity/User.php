<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use PlantBundle\Entity\Notification;
use PlantBundle\Entity\Plant;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="UserRepository")
 * @ORM\Table(name="fos_user")
 */

class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(
     *     targetEntity="PlantBundle\Entity\Plant",
     *     mappedBy="owner",
     *     orphanRemoval=true, cascade={"persist"}
     *     )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $plants;

    /**
     * @Assert\Length(max = 50,groups={"Profile", "Registration"})
     */
    protected $username;
    /**
     * @var Notification
     * @ORM\OneToMany(
     *     targetEntity="PlantBundle\Entity\Notification",
     *     mappedBy="user",
     *     orphanRemoval=true, cascade={"persist"}
     *     )
     */
    protected $notifications;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->plants = new ArrayCollection();
        $this->notifications = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get plants
     *
     * @return ArrayCollection
     */
    public function getPlants()
    {
        return $this->plants;
    }

    /**
     * Set plants
     *
     * @param $plants
     * @return $this
     */
    public function setPlants($plants)
    {
        $this->plants = $plants;
        return $this;
    }

    /**
     * @param Plant $plant
     * @return User
     */
    public function addPlant(Plant $plant)
    {
        $this->plants[] = $plant;

        return $this;
    }

    /**
     * @param Plant $plant
     * @return User
     */
    public function removePlant(Plant $plant)
    {
        if ($this->plants->contains($plant))
        {
            $this->plants->removeElement($plant);
        }
        return $this;
    }

    /**
     * Returns all notifications attached to the user
     * @return Notification|ArrayCollection
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * Adds a notification to the user
     * @param Notification $notification
     * @return User
     */
    public function addNotification($notification)
    {
        if (!$this->notifications->contains($notification))
        {
            $this->notifications[] = $notification;
            $notification->setUser($this);
        }

        return $this;
    }

    /**
     * Remove a notification to the user
     * @param Notification $notification
     * @return User
     */
    public function removeNotification($notification)
    {
        if ($this->notifications->contains($notification))
        {
            $this->notifications->removeElement($notification);
        }

        return $this;
    }

    /**
     * @param $subject
     * @return Notification|null
     */
    public function findNotaficationBySubject($subject)
    {
        foreach ($this->notifications as $notafication)
        {
            if($notafication->getSubject() === $subject )
            {
                return $notafication;
            }
        }
        return null;
    }
}

