<?php

/* -------------------------------------------- API routes ---------------------------------------------------------- */
Route::group(['prefix' => 'api'], function ()
{
    Route::group(['prefix' => 'v1'], function ()
    {
        ## Documentation
        Route::get('docs', ['as' => 'api.docs', 'uses' =>'Api\DocumentationController@show']);

        ## Authentication
        Route::get('auth', ['as' => 'api.auth', 'uses' =>'Api\AuthController@authorizeAndGetToken']);

        Route::group(['middleware' => 'auth:api'], function ()
        {
            Route::get('/secret', 'Api\SecretController@getSecret');
        });
    });
});

/* ------------------------------------------- Admin routes --------------------------------------------------------- */
Route::group(['prefix' => 'admin'], function()
{
    ## Admin login/logout
    Route::get('login', ['as' => 'admin.login', 'uses' =>'Admin\Auth\AuthController@getLogin']);
    Route::post('login', ['as' => 'admin.login.post', 'uses' =>'Admin\Auth\AuthController@postLogin']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' =>'Admin\Auth\AuthController@getLogout']);

    ## Models routes
    Route::group(['middleware' => 'admin'], function()
    {
        ## Admin index
        Route::get('/', ['as' => 'admin', 'uses' =>'Admin\IndexController@index']);

        ## Settings
        Route::get('settings', ['as' => 'admin.settings', 'uses' =>'Admin\SettingsController@index']);
        Route::post('settings', ['as' => 'admin.settings.save', 'uses' =>'Admin\SettingsController@save']);

        ## Users
        Route::resource('users', 'Admin\UsersController');

        ## Administrators
        Route::resource('administrators', 'Admin\AdministratorsController');
    });
});


/* --------------------------------------------- App routes --------------------------------------------------------- */
Route::group([], function ()
{
    ## Authentication / Registration / Password Reset
    Route::auth();

    ## Index
    Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
});