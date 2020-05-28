<?php

namespace ItAces\Oauth\Model;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class AuthCode extends \Laravel\Passport\AuthCode
{
    
    protected $primaryKey = 'primary';
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'd_oauth_auth_codes';
    
}
