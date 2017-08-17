<?php

namespace PlantBundle\Entity;

use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PlantSpecification
 *
 * @ORM\Table(name="plant_specification")
 * @ORM\Entity(repositoryClass="PlantBundle\Repository\PlantSpecificationRepository")
 */
class PlantSpecification
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     *
     * @Assert\NotBlank(message="Please enter a name.")
     * @Assert\Length(max=255, maxMessage="The name is too long.")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="latinName", type="string", length=255, nullable=true)
     *
     * @Assert\Length(max=255, maxMessage="The latin name is too long.")
     */
    private $latinName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     *
     * @Assert\Length(max=255, maxMessage="The description is too long.")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="frequency", type="integer")
     *
     * @Assert\NotBlank(message="Please enter a frequency.")
     */
    private $frequency;

    /**
     * @var int
     *
     * @ORM\Column(name="frequencyDays", type="integer")
     *
     * @Assert\NotBlank(message="Please enter a frequency days.")
     */
    private $frequencyDays;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     *
     * @Assert\NotBlank(message="Please enter an amount.")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255, nullable=true)
     *
     * @Assert\Length(max=255, maxMessage="The place is too long.")
     */
    private $place;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $author;

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
     * Get author
     *
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param User $author
     *
     * @return PlantSpecification
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PlantSpecification
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set latinName
     *
     * @param string $latinName
     *
     * @return PlantSpecification
     */
    public function setLatinName($latinName)
    {
        $this->latinName = $latinName;

        return $this;
    }

    /**
     * Get latinName
     *
     * @return string
     */
    public function getLatinName()
    {
        return $this->latinName;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return PlantSpecification
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set frequency
     *
     * @param integer $frequency
     *
     * @return PlantSpecification
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return int
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set frequencyDays
     *
     * @param integer $frequencyDays
     *
     * @return PlantSpecification
     */
    public function setFrequencyDays($frequencyDays)
    {
        $this->frequencyDays = $frequencyDays;

        return $this;
    }

    /**
     * Get frequencyDays
     *
     * @return int
     */
    public function getFrequencyDays()
    {
        return $this->frequencyDays;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return PlantSpecification
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set place
     *
     * @param string $place
     *
     * @return PlantSpecification
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }
}

