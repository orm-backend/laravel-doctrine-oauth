<?php
namespace ItAces\Oauth;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\Facades\Gate;
use ItAces\Oauth\Entities\AccessToken;
use ItAces\Oauth\Entities\AuthCode;
use ItAces\Oauth\Entities\Client;
use ItAces\Oauth\Entities\PersonalAccessClient;
use ItAces\Oauth\Entities\RefreshToken;
use ItAces\Utility\Helper;
use ItAces\Utility\Str;
use ItAces\Web\Events\BeforMenu;
use ItAces\Web\Menu\Menu;
use ItAces\Web\Menu\MenuFactory;

class OauthMenuListener
{
    
    /**
     * 
     * @var \ItAces\Web\Menu\MenuFactory
     */
    protected $factory;
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    
    public function __construct(MenuFactory $factory, EntityManager $em)
    {
        $this->factory = $factory;
        $this->em = $em;
    }
    
    public function handle(BeforMenu $event)
    {
        $currentRoute = request()->route()->action['as'];
        $activeModel = request()->route()->parameters['model'] ?? null;
        $isActive = Str::startsWith($currentRoute, 'admin.oauth');

        $oauth = new Menu([
            'url' => 'javascript:;',
            'name' => __('Oauth'),
            'title' => __('Entity List'),
            'active' => $isActive,
            'icon' => config('admin.icons.oauth', 'flaticon2-shield'),
            'open' => $isActive
        ]);

        $classNames = [AccessToken::class, AuthCode::class, Client::class, PersonalAccessClient::class, RefreshToken::class];
        
        foreach ($classNames as $className) {
            $classUrlName = Helper::classToUrl($className);
            $submenu = $this->getMenuForClass($className, $classUrlName, $currentRoute, $activeModel);
            
            if ($submenu) {
                $oauth->addSubmenuElement($classUrlName, $submenu);
            }
        }

        $this->factory->getMenu('admin')->addSubmenuElement('oauth', $oauth);
        //dd($this->factory->getMenuValue('admin'));
    }

    /**
     * 
     * @param string $className
     * @param string $classUrlName
     * @param string $currentRoute
     * @param string $activeModel
     * @return NULL|\ItAces\Web\Menu\Menu
     */
    protected function getMenuForClass(string $className, string $classUrlName, string $currentRoute, string $activeModel = null)
    {
        if (!Gate::inspect('read', $classUrlName)->allowed()) {
            return null;
        }
        
        $metadata = $this->em->getMetadataFactory()->getMetadataFor($className);
        $reflectionClass = new \ReflectionClass($className);
        $classShortName = $reflectionClass->getShortName();
        
        $menu = new Menu([
            'url' => 'javascript:;',
            'name' => __( Str::pluralCamelWords($classShortName) ),
            'title' => $metadata->name,
            'active' => $activeModel && $activeModel == $classUrlName
        ]);
        
        if (Gate::inspect('read', $classUrlName)->allowed()) {
            $menu->addSubmenuElement('search', new Menu([
                'url' => route('admin.oauth.search', $classUrlName, false),
                'name' => __('Search'),
                'title' => __('Element List'),
                'active' => $activeModel && $activeModel == $classUrlName && $currentRoute == 'admin.oauth.search'
            ]));
        }
        
        if (Gate::inspect('create', $classUrlName)->allowed()) {
            $menu->addSubmenuElement('create', new Menu([
                'url' => route('admin.oauth.create', $classUrlName, false),
                'name' => __('Create'),
                'title' => __('Add New Element'),
                'active' => $activeModel && $activeModel == $classUrlName && $currentRoute == 'admin.oauth.create'
            ]));
        }
        
        if (Gate::inspect('settings')->allowed()) {
            $menu->addSubmenuElement('settings', new Menu([
                'url' => route('admin.oauth.settings', $classUrlName, false),
                'name' => __('Settings'),
                'title' => __('Entity Settings'),
                'active' => $activeModel && $activeModel == $classUrlName && Str::startsWith($currentRoute, 'admin.oauth.settings')
            ]));
        }
        
        return $menu;
    }

}