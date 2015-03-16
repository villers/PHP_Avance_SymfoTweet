<?php

namespace Twit\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

class User extends BaseUser
{

    protected $id;

    protected $twitter_id;

    protected $twitter_access_token;

    protected $twitter_secret_token;
   

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
     * Set twitter_id
     *
     * @param string $twitterId
     * @return User
     */
    public function setTwitterId($twitterId)
    {
        $this->twitter_id = $twitterId;

        return $this;
    }

    /**
     * Get twitter_id
     *
     * @return string 
     */
    public function getTwitterId()
    {
        return $this->twitter_id;
    }

    /**
     * Set twitter_access_token
     *
     * @param string $twitterAccessToken
     * @return User
     */
    public function setTwitterAccessToken($twitterAccessToken)
    {
        $this->twitter_access_token = $twitterAccessToken;

        return $this;
    }

    /**
     * Get twitter_access_token
     *
     * @return string 
     */
    public function getTwitterAccessToken()
    {
        return $this->twitter_access_token;
    }

    /**
     * Set twitter_secret_token
     *
     * @param string $twitterSecretToken
     * @return User
     */
    public function setTwitterSecretToken($twitterSecretToken)
    {
        $this->twitter_secret_token = $twitterSecretToken;

        return $this;
    }

    /**
     * Get twitter_secret_token
     *
     * @return string 
     */
    public function getTwitterSecretToken()
    {
        return $this->twitter_secret_token;
    }
}
