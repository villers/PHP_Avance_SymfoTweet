<?php

namespace Twit\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wall
 */
class Wall
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var string
     */
    private $value;

    /**
     * @var integer
     */
    private $moderate;

    /**
     * @var \Twit\UserBundle\Entity\User
     */
    private $user;


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
     * Set type
     *
     * @param integer $type
     * @return Wall
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Wall
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set moderate
     *
     * @param integer $moderate
     * @return Wall
     */
    public function setModerate($moderate)
    {
        $this->moderate = $moderate;

        return $this;
    }

    /**
     * Get moderate
     *
     * @return integer 
     */
    public function getModerate()
    {
        return $this->moderate;
    }

    /**
     * Set user
     *
     * @param \Twit\UserBundle\Entity\User $user
     * @return Wall
     */
    public function setUser(\Twit\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Twit\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
