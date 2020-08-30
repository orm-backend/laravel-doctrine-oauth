<?php

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
namespace VVK\Oauth\Entities;

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
     * @var \VVK\Oauth\Entities\Client
     */
    protected $client;

    /**
     * @return \VVK\Oauth\Entities\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \VVK\Oauth\Entities\Client $client
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
