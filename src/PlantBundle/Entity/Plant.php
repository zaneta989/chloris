<?php
namespace PlantBundle\Entity;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
/**
 * plant
 *
 * @ORM\Table(name="plant")
 * @ORM\Entity(repositoryClass="PlantBundle\Repository\PlantRepository")
 */
class Plant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_watered", type="boolean", nullable=true)
     */
    private $isWatered;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="plants")
     */
    private $owner;
    /**
     * @ORM\ManyToOne(targetEntity="PlantBundle\Entity\PlantSpecification")
     */
    private $plantSpecification;
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
     * Get isWatered
     *
     * @return boolean
     */
    public function getIsWatered()
    {
        return $this->isWatered;
    }
    /**
     * Set isWatered
     *
     * @param boolean $isWatered
     *
     * @return Plant
     */
    public function setIsWatered($isWatered)
    {
        $this->isWatered = $isWatered;
        return $this;
    }
    /**
     * Get owner
     *
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set owner
     *
     * @param User $owner
     *
     * @return Plant
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get plantSpecification
     *
     * @return PlantSpecification
     */
    public function getPlantSpecification()
    {
        return $this->plantSpecification;
    }

    /**
     * Set plantSpecification
     *
     * @param PlantSpecification $plantSpecification
     *
     * @return Plant
     */
    public function setPlantSpecification($plantSpecification)
    {
        $this->plantSpecification = $plantSpecification;

        return $this;
    }
}

