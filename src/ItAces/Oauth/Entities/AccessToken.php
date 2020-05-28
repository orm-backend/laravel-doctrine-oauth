<?php

namespace ItAces\Oauth\Entities;

use ItAces\UnderAdminControl;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class AccessToken extends \ItAces\ORM\Entities\EntityBase implements UnderAdminControl
{

    /**
     * 
     * @var string
     */
    protected $primary;
    
    /**
     * @var \App\Model\User
     */
    protected $user;

    /**
     * @var \ItAces\Oauth\Entities\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $scopes;

    /**
     * @var boolean
     */
    protected $revoked;

    /**
     * @var \Carbon\Carbon
     */
    protected $expiresAt;
    
    /**
     * @return string
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * @param string $primary
     */
    public function setPrimary($primary)
    {
        $this->primary = $primary;
    }

    /**
     * @return \App\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return \ItAces\Oauth\Entities\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \App\Model\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param \ItAces\Oauth\Entities\Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @return boolean
     */
    public function isRevoked()
    {
        return $this->revoked;
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $scopes
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
    }

    /**
     * @param boolean $revoked
     */
    public function setRevoked($revoked)
    {
        $this->revoked = $revoked;
    }

    /**
     * @param \Carbon\Carbon $expiresAt
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * 
     * @return array
     */
    public static function getRequestValidationRules()
    {
        return [];
    }

    public function getModelValidationRules()
    {
        return [];
    }

}