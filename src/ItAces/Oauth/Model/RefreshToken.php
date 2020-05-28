<?php

namespace ItAces\Oauth\Model;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class RefreshToken extends \Laravel\Passport\RefreshToken
{
    
    protected $primaryKey = 'primary';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'd_oauth_refresh_tokens';

}
