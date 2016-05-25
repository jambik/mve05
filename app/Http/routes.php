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
            ## Upload fuel tickets file
            Route::post('fuel_tickets', ['as' => 'api.fuel_tickets.upload', 'uses' =>'Api\FuelTicketController@uploadFuelTicketsFile']);
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

        ## Fuel tickets
        Route::resource('fuel_tickets', 'Admin\FuelTicketsController');

        ## Fuel tickets
        Route::resource('fuel_files', 'Admin\FuelFilesController');

        ## Users 1C
        Route::resource('users1c', 'Admin\Users1cController');

        ## Administrators
        Route::resource('administrators', 'Admin\AdministratorsController');

        ## Import Fuel Tickets
        Route::get('fuel_tickets_upload', ['as' => 'admin.fuel_tickets_upload.show', 'uses' =>'Admin\FuelTicketsUploadController@show']);
        Route::post('fuel_tickets_upload', ['as' => 'admin.fuel_tickets_upload.upload', 'uses' =>'Admin\FuelTicketsUploadController@upload']);
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