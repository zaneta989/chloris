<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use PlantBundle\Entity\Plant;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="UserRepository")
 * @ORM\Table(name="fos_user")
 * @Vich\Uploadable
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
     * @ORM\OneToOne(
     *     targetEntity="AppBundle\Entity\UserPreferences",
     *     orphanRemoval=true, cascade={"persist"}
     *     )
     * * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $preferences;

    /**
     * @Assert\Length(max = 50,groups={"Profile", "Registration"})
     */
    protected $username;

    /**
     * @Vich\UploadableField(mapping="user_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName")
     *
     * @var File
     */
    private $imageFile;


    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->plants = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->preferences = new UserPreferences();
        $this->image = new EmbeddedFile();
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

    public function haveAnyPlantsNeedWatering()
    {
        foreach ($this->plants as $plant)
        {
            if(!$plant->getIsWatered())
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * @param mixed $preferences
     */
    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;
    }

    /**
     * @param File|UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if (null !== $image) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage(EmbeddedFile $image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }
}

