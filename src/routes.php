<?php
use Illuminate\Support\Facades\Route;
use ItAces\Admin\Controllers\SettingsController;
use ItAces\Oauth\Controllers\OauthController;

Route::group(array(
    'prefix' => 'admin/oauth',
    'middleware' => [
        'web',
        'auth',
        'verified',
        'can:dashboard',
        'menu'
    ]
), function () {
    Route::get('/{model}', OauthController::class . '@search')->name('admin.oauth.search')->middleware('can:read,model');
    Route::post('/{model}', OauthController::class . '@store')->name('admin.oauth.store')->middleware('can:create,model');
    Route::get('/{model}/create', OauthController::class . '@create')->name('admin.oauth.create')->middleware('can:create,model');
    Route::get('/{model}/edit/{id}', OauthController::class . '@edit')->name('admin.oauth.edit')->middleware('can:update,model');
    Route::get('/{model}/details/{id}', OauthController::class . '@details')->name('admin.oauth.details')->middleware('can:read,model');
    Route::post('/{model}/update/{id}', OauthController::class . '@update')->name('admin.oauth.update')->middleware('can:update,model');
    Route::get('/{model}/delete/{id}', OauthController::class . '@delete')->name('admin.oauth.delete')->middleware('can:delete,model');
    Route::post('/{model}/batch-delete', OauthController::class . '@batchDelete')->name('admin.oauth.batchDelete')->middleware('can:delete,model');
    Route::get('/{model}/settings', SettingsController::class . '@settings')->name('admin.oauth.settings')->middleware('can:settings');
    Route::post('/{model}/settings/permissions', SettingsController::class . '@updatePermissions')->name('admin.entity.settings.permissions.update')->middleware('can:settings');
});
