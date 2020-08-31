<?php

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
namespace OrmBackend\Oauth\Entities;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class PersonalAccessClient extends OauthEntity
{

    /**
     *
     * @var integer
     */
    protected $id;
    
    /**
     * @var \OrmBackend\Oauth\Entities\Client
     */
    protected $client;

    /**
     * @return \OrmBackend\Oauth\Entities\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \OrmBackend\Oauth\Entities\Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
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
