<?php

namespace OC\TrickBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="OC\TrickBundle\Repository\VideoRepository")
 */
class Video
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
     * @ORM\Column(name="link", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $link;

    /**
     * @ORM\ManyToOne(targetEntity="Trick", inversedBy="videos")
     * @ORM\JoinColumn(name="trick_id", referencedColumnName="id", nullable=false)
     */
    private $trick;

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
     * Set link
     *
     * @param string $link
     *
     * @return Video
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set trick
     *
     * @param \OC\TrickBundle\Entity\Trick $trick
     *
     * @return Video
     */
    public function setTrick(\OC\TrickBundle\Entity\Trick $trick)
    {
        $this->trick = $trick;

        return $this;
    }

    /**
     * Get trick
     *
     * @return \OC\TrickBundle\Entity\Trick
     */
    public function getTrick()
    {
        return $this->trick;
    }
}
