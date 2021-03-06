<?php

/* -------------------------------------------- API routes ---------------------------------------------------------- */
Route::group(['prefix' => 'api'], function ()
{
    Route::group(['prefix' => 'v1'], function ()
    {
        /* Documentation */
        Route::get('docs', ['as' => 'api.docs', 'uses' =>'Api\DocumentationController@show']);

        /* Api routes */
        Route::group(['middleware' => 'api'], function ()
        {
            /* 1C Api routes */
            Route::group(['prefix' => '1c'], function ()
            {
                // Authentication
                Route::get('auth', ['as' => 'api.1c.auth', 'uses' =>'Api\AuthController@authorizeAndGetToken1c']);

                Route::group(['middleware' => ['auth:api', 'api']], function ()
                {
                    // Upload fuel tickets file
                    Route::post('fuel_tickets', ['as' => 'api.1c.fuel_tickets.upload', 'uses' =>'Api\FuelTicketController@uploadFuelTicketsFile']);
                });
            });

            /* Mobile Api routes */
            // Authentication
            Route::get('auth', ['as' => 'api.auth', 'uses' =>'Api\AuthController@authorizeAndGetToken']);

            Route::group(['middleware' => ['auth:api']], function ()
            {
                // Check if Token is valid
                Route::get('check_token', ['as' => 'api.check_token', 'uses' => 'Api\AuthController@checkToken']);
                // Get fuel ticket information
                Route::get('fuel_ticket', ['as' => 'api.fuel_ticket', 'uses' => 'Api\FuelTicketController@getFuelTicketInfo']);
                // Use fuel tickets
                Route::get('use_fuel_tickets', ['as' => 'api.use_fuel_ticket', 'uses' => 'Api\FuelTicketController@useFuelTickets']);
            });
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

        ## Azs
        Route::resource('azs', 'Admin\AzsController');

        ## Pages
        Route::resource('pages', 'Admin\PagesController');

        ## Blocks
        Route::resource('blocks', 'Admin\BlocksController');

        ## News
        Route::resource('news', 'Admin\NewsController');

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
        Route::resource('users_1c', 'Admin\Users1cController');

        ## Users Azs
        Route::resource('users_azs', 'Admin\UsersAzsController');
        Route::get('users_azs/{id}/refresh_api_token', ['as' => 'admin.users_azs.refresh_api_token', 'uses' => 'Admin\UsersAzsController@refreshApiToken'])->where('id', '[0-9]+');

        ## Log Access
        Route::resource('log_access', 'Admin\LogAccessController');

        ## Administrators
        Route::resource('administrators', 'Admin\AdministratorsController');

        ## Sortable routes
        Route::post('sort', ['as' => 'sort', 'uses' => '\Rutorika\Sortable\SortableController@sort']);

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

    ## Azs
    Route::get('azs', ['as' => 'azs', 'uses' => 'AzsController@index']);

    ## Pages
    Route::get('page/{slug}', ['as' => 'page.show', 'uses' => 'PagesController@show']);

    ## News
    Route::get('news', ['as' => 'news', 'uses' => 'NewsController@index']);
    Route::get('news/{id}', ['as' => 'news.show', 'uses' => 'NewsController@show']);

    # Feedback
    Route::get('feedback', ['as' => 'feedback', 'uses' => 'CommonController@feedback']);
    Route::post('feedback', ['as' => 'feedback.send', 'uses' => 'CommonController@feedbackSend']);

    ## Callback
    Route::post('callback', ['as' => 'callback', 'uses' => 'CommonController@callback']);
});