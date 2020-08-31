<?php
namespace OrmBackend\Oauth;

use Doctrine\ORM\EntityManagerInterface;
use Laravel\Passport\Passport;
use OrmBackend\ServiceProvider;
use OrmBackend\Oauth\Model\AccessToken;
use OrmBackend\Oauth\Model\AuthCode;
use OrmBackend\Oauth\Model\PersonalAccessClient;
use OrmBackend\Oauth\Model\RefreshToken;
use OrmBackend\Oauth\Model\Client;

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
                base_path('vendor/vvk/laravel-doctrine-oauth/src/OrmBackend/Oauth/Entities') => 'OrmBackend\Oauth\Entities'
            ],
            'OrmBackend\Oauth\Entities'
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
