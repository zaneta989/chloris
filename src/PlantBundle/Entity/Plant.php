<?php
namespace PlantBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Plant
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
     * @ORM\Column(name="isWatered", type="boolean", nullable=true)
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
}

