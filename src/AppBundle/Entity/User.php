<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
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
     * @ORM\OneToMany(targetEntity="PlantBundle\Entity\Plant", mappedBy="owner", cascade={"remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $plants;

    /**
     * @Assert\Length(max = 50,groups={"Profile", "Registration"})
     */
    protected $username;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->plants = new ArrayCollection();
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
     * Set plantSpecification
     *
     * @param array $plants
     * @return User
     */
    public function setPlants($plants)
    {
        $this->plants = $plants;

        return $this;
    }
}

