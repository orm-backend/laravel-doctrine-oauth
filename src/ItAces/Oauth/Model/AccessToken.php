<?php

namespace VVK\Oauth\Model;


/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class AccessToken extends \Laravel\Passport\Token
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'd_oauth_access_tokens';
    
    public static function booted()
    {
        self::creating(function($model) {
            if (app()->runningInConsole()) {
                $model->created_by = 1;
            } else {
                $model->created_by = auth()->id();
            }
            
            $model->created_at = now();
        });
    }

}
