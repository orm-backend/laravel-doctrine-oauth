<?php
namespace ItAces\Oauth;

use Doctrine\ORM\EntityManagerInterface;
use Laravel\Passport\Passport;
use ItAces\ServiceProvider;
use ItAces\Oauth\Model\AccessToken;
use ItAces\Oauth\Model\AuthCode;
use ItAces\Oauth\Model\PersonalAccessClient;
use ItAces\Oauth\Model\RefreshToken;
use ItAces\Oauth\Model\Client;

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
                base_path('vendor/it-aces/laravel-doctrine-oauth/src/ItAces/Oauth/Entities') => 'ItAces\Oauth\Entities'
            ],
            'ItAces\Oauth\Entities'
        );
        
        $this->loadRoutesFrom(__DIR__.'/../../routes.php');
        
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
