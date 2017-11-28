<?php

namespace OC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="OC\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="gravurl", type="string", length=255)
     */
    private $gravUrl;
	
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
     * Set gravUrl
     *
     * @param string $gravUrl
     *
     * @return User
     */
    public function setGravUrl($gravUrl)
    {
        $this->gravUrl = $gravUrl;

        return $this;
    }

    /**
     * Get gravUrl
     *
     * @return string
     */
    public function getGravUrl()
    {
        return $this->gravUrl;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        $this->setGravUrl("https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=mm&r=g");

        return $this;
    }
}
