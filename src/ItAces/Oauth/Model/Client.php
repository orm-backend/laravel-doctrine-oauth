<?php

namespace ItAces\Oauth\Model;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class Client extends \Laravel\Passport\Client
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'd_oauth_clients';

}
