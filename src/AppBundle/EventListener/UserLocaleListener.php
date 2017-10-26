<?php
namespace AppBundle\EventListener;

use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class UserLocaleListener
{
    /**
     * @var Session
     */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param FormEvent $event
     */
    public function onEditSuccess(FormEvent $event)
    {
        $locale = $event->getForm()->getData()->getPreferences()->getLocale();
        $this->session->set('_locale', $locale);
    }
    /**
     * @param InteractiveLoginEvent $event
     */
    public function onInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $lang = $user->getPreferences()->getLocale();
        if (null !== $lang) {
            $this->session->set('_locale', $lang);
        }
    }
}

