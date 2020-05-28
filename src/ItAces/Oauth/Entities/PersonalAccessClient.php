<?php

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
namespace ItAces\Oauth\Entities;

use ItAces\UnderAdminControl;


/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class PersonalAccessClient extends \ItAces\ORM\Entities\EntityBase implements UnderAdminControl
{

    /**
     * @var \ItAces\Oauth\Entities\Client
     */
    protected $client;

    /**
     * @return \ItAces\Oauth\Entities\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \ItAces\Oauth\Entities\Client $client
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
