<?php

namespace ItAces\Oauth\Model;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class AccessToken extends \Laravel\Passport\Token
{
    
    protected $primaryKey = 'primary';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'd_oauth_access_tokens';
    
}
