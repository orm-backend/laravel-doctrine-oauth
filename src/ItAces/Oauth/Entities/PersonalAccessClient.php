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
     * @var integer
     */
    protected $clientId;
    
    /**
     * @return integer
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param number $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
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
