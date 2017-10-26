<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="UserPreferencesRepository")
 * @ORM\Table(name="user_preferences")
 */
class UserPreferences
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", options={"default" : "en"})
     * @Assert\Choice(
     *     choices = { "pl", "en" },
     *     message = "Invalid locale"
     * )
     */
    protected $locale;

    /**
     * @ORM\Column(type="string", options={"default" : "tableView"})
     * @Assert\Choice(
     *     choices = { "tableView", "cardView" },
     *     message = "Invalid view"
     * )
     */
    protected $view;

    public function __construct()
    {
        $this->locale = 'en';
        $this->view = 'tableView';
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param mixed $view
     * @return UserPreferences
     */
    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}

