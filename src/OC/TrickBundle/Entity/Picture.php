<?php

namespace OC\TrickBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="OC\TrickBundle\Repository\PictureRepository")
 * @Vich\Uploadable
 */
class Picture
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
     * @Vich\UploadableField(mapping="trick_picture", fileNameProperty="pictureName", size="pictureSize")
     * 
     * @var File
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $pictureName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $pictureSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="OC\TrickBundle\Entity\Trick", inversedBy="pictures")
     * @ORM\JoinColumn(name="trick_id", referencedColumnName="id", nullable=false)
     */
    private $trick;


    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $picture
     *
     * @return Picture
     */
    public function setPictureFile(File $picture = null)
    {
        $this->pictureFile = $picture;

        if ($picture) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
        
        return $this;
    }

    /**
     * @return File|null
     */
    public function getPictureFile()
    {
        return $this->pictureFile;
    }

    /**
     * @param string $pictureName
     *
     * @return Picture
     */
    public function setPictureName($pictureName)
    {
        $this->pictureName = $pictureName;
        
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPictureName()
    {
        return $this->pictureName;
    }
    
    /**
     * @param integer $pictureSize
     *
     * @return Picture
     */
    public function setPictureSize($pictureSize)
    {
        $this->pictureSize = $pictureSize;
        
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getPictureSize()
    {
        return $this->pictureSize;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Picture
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set trick
     *
     * @param \OC\TrickBundle\Entity\Trick $trick
     *
     * @return Picture
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
