<?php

namespace ItAces\Oauth\Entities;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class Client extends OauthEntity
{

    /**
     * 
     * @var integer
     */
    protected $id;
    
    /**
     * @var \App\Model\User
     */
    protected $user;

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
    protected $personalAccessClient = false;

    /**
     * @var boolean
     */
    protected $passwordClient = false;

    /**
     * @var boolean
     */
    protected $revoked = false;

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
     * @return \App\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \App\Model\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
