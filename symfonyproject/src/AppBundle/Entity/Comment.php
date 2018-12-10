<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="writer", type="string", length=60)
     */
    private $writer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEcriture", type="date",nullable=True)
     */
    private $dateEcriture;

    /**
     * @var bool
     *
     * @ORM\Column(name="state", type="boolean",nullable=True)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string",nullable=True)
     */
    private $datte;

    /**
     * @return string
     */
    public function getDatte()
    {
        return $this->datte;
    }

    /**
     * @param string $datte
     */
    public function setDatte($datte)
    {
        $this->datte = $datte;
    }




    /**
     * @var string
     *
     * @ORM\Column(name="article_id", type="string", length=60)
     */
    private $article_id;

    /**
     * @return string
     */
    public function getArticleId()
    {
        return $this->article_id;
    }

    /**
     * @param string $article_id
     */
    public function setArticleId($article_id)
    {
        $this->article_id = $article_id;
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
     * Set content
     *
     * @param string $content
     *
     * @return Comment
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

    /**
     * Set writer
     *
     * @param string $writer
     *
     * @return Comment
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;

        return $this;
    }

    /**
     * Get writer
     *
     * @return string
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * Set dateEcriture
     *
     * @param \DateTime $dateEcriture
     *
     * @return Comment
     */
    public function setDateEcriture($dateEcriture)
    {
        $this->dateEcriture = $dateEcriture;

        return $this;
    }

    /**
     * Get dateEcriture
     *
     * @return \DateTime
     */
    public function getDateEcriture()
    {
        return $this->dateEcriture;
    }

    /**
     * Set state
     *
     * @param boolean $state
     *
     * @return Comment
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return bool
     */
    public function getState()
    {
        return $this->state;
    }
}

