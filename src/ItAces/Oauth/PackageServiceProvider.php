<?php
namespace VVK\Oauth;

use Doctrine\ORM\EntityManagerInterface;
use Laravel\Passport\Passport;
use VVK\ServiceProvider;
use VVK\Oauth\Model\AccessToken;
use VVK\Oauth\Model\AuthCode;
use VVK\Oauth\Model\PersonalAccessClient;
use VVK\Oauth\Model\RefreshToken;
use VVK\Oauth\Model\Client;

/**
 *
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class PackageServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     * 
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @return void
     */
    public function boot(EntityManagerInterface $manager)
    {
        $this->bootModel(
            $manager,
            [
                base_path('vendor/vvk/laravel-doctrine-oauth/src/VVK/Oauth/Entities') => 'VVK\Oauth\Entities'
            ],
            'VVK\Oauth\Entities'
        );
        
        $this->loadRoutesFrom(__DIR__.'/../../routes.php');
        $this->loadViewsFrom(__DIR__.'/../../../resources/views', 'oauth');
        
        Passport::routes();
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::useClientModel(Client::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
        Passport::useRefreshTokenModel(RefreshToken::class);
        Passport::useTokenModel(AccessToken::class);
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations();
    }

}
