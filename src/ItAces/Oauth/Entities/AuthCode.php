<?php

namespace ItAces\Oauth\Entities;

use ItAces\UnderAdminControl;


/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class AuthCode extends \ItAces\ORM\Entities\EntityBase implements UnderAdminControl
{

    /**
     *
     * @var string
     */
    protected $primary;
    
    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var integer
     */
    protected $clientId;

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
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return integer
     */
    public function getClientId()
    {
        return $this->clientId;
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
     * @param integer $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param integer $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
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
