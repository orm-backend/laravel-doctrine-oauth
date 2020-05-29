<?php

namespace ItAces\Oauth\Entities;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class RefreshToken extends OauthEntity
{

    /**
     *
     * @var string
     */
    protected $id;
    
    /**
     * @var integer
     */
    protected $accessTokenId;

    /**
     * @var boolean
     */
    protected $revoked;

    /**
     * @var \Carbon\Carbon
     */
    protected $expiresAt;

    /**
     * @return integer
     */
    public function getAccessTokenId()
    {
        return $this->accessTokenId;
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
     * @param integer $accessTokenId
     */
    public function setAccessTokenId($accessTokenId)
    {
        $this->accessTokenId = $accessTokenId;
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
