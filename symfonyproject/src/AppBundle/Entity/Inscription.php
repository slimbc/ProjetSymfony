<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscription
 *
 * @ORM\Table(name="inscription")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InscriptionRepository")
 */
class Inscription
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event")
     */
    private $event;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;

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
     * Set event
     *
     * @param Event $event
     *
     * @return Inscription
     */
    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * Get event
     *
     * @return int
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Inscription
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }
}
