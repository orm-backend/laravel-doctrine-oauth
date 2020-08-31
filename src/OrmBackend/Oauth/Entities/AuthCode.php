<?php

namespace OrmBackend\Oauth\Entities;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class AuthCode extends OauthEntity
{
    
    /**
     *
     * @var string
     */
    protected $id;
    
    /**
     * @var \App\Model\User
     */
    protected $user;

    /**
     * @var \OrmBackend\Oauth\Entities\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $scopes;

    /**
     * @var boolean
     */
    protected $revoked = false;

    /**
     * @var \Carbon\Carbon
     */
    protected $expiresAt;
    
    /**
     * @return \App\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return \OrmBackend\Oauth\Entities\Client
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
     * @param \OrmBackend\Oauth\Entities\Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
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

    public static function getRequestValidationRules()
    {
        return [];
    }

    public function getModelValidationRules()
    {
        return [];
    }

}
