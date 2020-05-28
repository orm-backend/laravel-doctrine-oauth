<?php

namespace ItAces\Oauth\Entities;

use ItAces\UnderAdminControl;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class Clients extends \ItAces\ORM\Entities\EntityBase implements UnderAdminControl
{

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var string
     */
    protected $redirect;

    /**
     * @var boolean
     */
    protected $personalAccessClient;

    /**
     * @var boolean
     */
    protected $passwordClient;

    /**
     * @var boolean
     */
    protected $revoked;
    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
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
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @return boolean
     */
    public function isPersonalAccessClient()
    {
        return $this->personalAccessClient;
    }

    /**
     * @return boolean
     */
    public function isPasswordClient()
    {
        return $this->passwordClient;
    }

    /**
     * @return boolean
     */
    public function isRevoked()
    {
        return $this->revoked;
    }

    /**
     * @param integer $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @param string $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * @param boolean $personalAccessClient
     */
    public function setPersonalAccessClient($personalAccessClient)
    {
        $this->personalAccessClient = $personalAccessClient;
    }

    /**
     * @param boolean $passwordClient
     */
    public function setPasswordClient($passwordClient)
    {
        $this->passwordClient = $passwordClient;
    }

    /**
     * @param boolean $revoked
     */
    public function setRevoked($revoked)
    {
        $this->revoked = $revoked;
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
