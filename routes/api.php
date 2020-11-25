<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Authentication & Password Reset
//----------------------------------

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'Auth\LoginAPIController@login');
    Route::post('register', 'Auth\LoginAPIController@register');
    Route::post('refresh_token', 'Auth\LoginAPIController@refresh');
});

Route::group(['middleware' => ['auth.jwt']], function () {
    Route::post('auth/logout', 'Auth\LoginAPIController@logout');
    Route::get('auth/user', 'Auth\LoginAPIController@me');

    Route::get('/bootstrap', [
        'as' => 'bootstrap',
        'uses' => 'Api\UserController@getBootstrap'
    ]);

    Route::apiResource('clients', 'Api\ClientController');
    Route::apiResource('categories', 'Api\CategoryController');
    Route::apiResource('products', 'Api\ProductController');
    Route::apiResource('ingredients', 'Api\IngredientController');
    Route::apiResource('employees', 'Api\EmployeeController');
    Route::apiResource('providers', 'Api\ProviderController');

    //VENTA Y DETALLE VENTA
    Route::post('invoices/createDetail', 'Api\InvoiceDetailController')->name('invoices.createDetail');
    //COMPRA Y DETALLE COMPRA
    Route::post('bills/createDetail', 'Api\BillDetailController')->name('bills.createDetail');
    //ALMACEN
    Route::apiResource('storageItems', 'Api\StorageItemsViewController')->only(['index', 'show']);
    Route::apiResource('storages', 'Api\StorageController')->only(['index', 'show', 'update']);
});


// Country, State & City
//----------------------------------

Route::get('/countries', [
    'as' => 'countries',
    'uses' => 'LocationController@getCountries'
]);




// Onboarding
//----------------------------------
Route::group(['middleware' => 'redirect-if-installed'], function () {

    Route::get('/admin/onboarding', [
        'as' => 'admin.onboarding',
        'uses' => 'Onboard\OnboardingController@getOnboardingData'
    ]);

    Route::get('/admin/onboarding/requirements', [
        'as' => 'admin.onboarding.requirements',
        'uses' => 'Onboard\RequerimentsController@requirements'
    ]);

    Route::get('/admin/onboarding/permissions', [
        'as' => 'admin.onboarding.permissions',
        'uses' => 'Onboard\PermissionsController@permissions'
    ]);

    Route::post('/admin/onboarding/environment/database', [
        'as' => 'admin.onboarding.database',
        'uses' => 'Onboard\EnvironmentController@saveDatabaseEnvironment'
    ]);

    Route::get('/admin/onboarding/environment/mail', [
        'as' => 'admin.onboarding.mail',
        'uses' => 'Onboard\EnvironmentController@getMailDrivers'
    ]);

    Route::post('/admin/onboarding/environment/mail', [
        'as' => 'admin.onboarding.mail',
        'uses' => 'Onboard\EnvironmentController@saveMailEnvironment'
    ]);

    Route::post('/admin/onboarding/profile', [
        'as' => 'admin.profile',
        'uses' => 'Onboard\OnboardingController@adminProfile'
    ]);

    Route::post('/admin/profile/upload-avatar', [
        'as' => 'admin.on_boarding.avatar',
        'uses' => 'Onboard\OnboardingController@uploadAdminAvatar'
    ]);

    Route::post('/admin/onboarding/company', [
        'as' => 'admin.company',
        'uses' => 'Onboard\OnboardingController@adminCompany'
    ]);

    Route::post('/admin/onboarding/company/upload-logo', [
        'as' => 'upload.admin.company.logo',
        'uses' => 'Onboard\OnboardingController@uploadCompanyLogo'
    ]);

    Route::post('/admin/onboarding/settings', [
        'as' => 'admin.settings',
        'uses' => 'Onboard\OnboardingController@companySettings'
    ]);
});
