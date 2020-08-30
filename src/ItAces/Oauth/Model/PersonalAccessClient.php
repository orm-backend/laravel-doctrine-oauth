<?php

namespace VVK\Oauth\Model;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class PersonalAccessClient extends \Laravel\Passport\PersonalAccessClient
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'd_oauth_personal_access_clients';

    public static function booted()
    {
        self::creating(function($model){
            if (app()->runningInConsole()) {
                $model->created_by = 1;
            } else {
                $model->created_by = auth()->id();
            }
            
            $model->created_at = now();
        });
    }
    
}
