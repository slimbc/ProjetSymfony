<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="name", type="string", length=60)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEcriture", type="date",nullable=True)
     */
    private $dateEcriture;

    /**
     * @return \DateTime
     */
    public function getDateEcriture()
    {
        return $this->dateEcriture;
    }

    /**
     * @param \DateTime $dateEcriture
     */
    public function setDateEcriture($dateEcriture)
    {
        $this->dateEcriture = $dateEcriture;
    }


    /**
     * @var string
     *
     *  @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $creater;
    /**
     * @var string
     *
     * @ORM\Column(name="state", type="boolean",nullable=True)
     */
    private $state;

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getCreater()
    {
        return $this->creater;
    }

    /**
     * @param string $creater
     */
    public function setCreater($creater)
    {
        $this->creater = $creater;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="approved", type="integer")
     *
     * @ORM\GeneratedValue(strategy="AUTO")
     */
        private $approved;
    /**
     * Get approved
     *
     * @return int
     */
    public function getApproved()
    {
        return $this->approved;
    }


    /**
     * Set approved
     *
     * @param integer $approved
     *
     * @return Article
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
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
     * Set name
     *
     * @param string $name
     *
     * @return Article
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
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}

