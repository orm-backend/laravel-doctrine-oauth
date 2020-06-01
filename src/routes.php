<?php
use Illuminate\Support\Facades\Route;
use ItAces\Admin\Controllers\SettingsController;
use ItAces\Oauth\Controllers\OauthController;

Route::group([
    'prefix' => '/admin/oauth/{model}',
    'middleware' => [
        'web',
        'auth',
        'verified',
        'can:dashboard',
        'menu'
    ]
], function () {
    Route::get('/', OauthController::class . '@search')
        ->name('admin.oauth.search')
        ->defaults('group', 'oauth')
        ->middleware('can:read,model');
    
    Route::post('/', OauthController::class . '@store')
        ->name('admin.oauth.store')
        ->defaults('group', 'oauth')
        ->middleware('can:create,model');
    
    Route::get('/create', OauthController::class . '@create')
        ->name('admin.oauth.create')
        ->defaults('group', 'oauth')
        ->middleware('can:create,model');
    
    Route::get('/edit/{id}', OauthController::class . '@edit')
        ->name('admin.oauth.edit')
        ->defaults('group', 'oauth')
        ->middleware('can:update,model');
    
    Route::get('/details/{id}', OauthController::class . '@details')
        ->name('admin.oauth.details')
        ->defaults('group', 'oauth')
        ->middleware('can:read,model');
    
    Route::post('/update/{id}', OauthController::class . '@update')
        ->name('admin.oauth.update')
        ->defaults('group', 'oauth')
        ->middleware('can:update,model');
    
    Route::get('/delete/{id}', OauthController::class . '@delete')
        ->name('admin.oauth.delete')
        ->defaults('group', 'oauth')
        ->middleware('can:delete,model');
    
    Route::post('/batch-delete', OauthController::class . '@batchDelete')
        ->name('admin.oauth.batchDelete')
        ->defaults('group', 'oauth')
        ->middleware('can:delete,model');
    
    Route::get('/settings', SettingsController::class . '@settings')
        ->name('admin.oauth.settings')
        ->defaults('group', 'oauth')
        ->middleware('can:settings');
    
    Route::post('/settings/permissions', SettingsController::class . '@updatePermissions')
        ->name('admin.oauth.settings.permissions.update')
        ->defaults('group', 'oauth')
        ->middleware('can:settings');
});
