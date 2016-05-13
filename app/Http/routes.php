<?php

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

        ## Categories
        Route::resource('categories', 'Admin\CategoriesController');
        Route::match(['get', 'post'], 'categories/move', ['as' => 'admin.categories.move', 'uses' =>'Admin\CategoriesController@move']);

        ## Products
        Route::resource('products', 'Admin\ProductsController');

        ## Galleries
        Route::resource('galleries', 'Admin\GalleriesController');

        ## Photos
        Route::resource('photos', 'Admin\PhotosController');

        ## Pages
        Route::resource('pages', 'Admin\PagesController');

        ## Blocks
        Route::resource('blocks', 'Admin\BlocksController');

        ## News
        Route::resource('news', 'Admin\NewsController');

        ## Articles
        Route::resource('articles', 'Admin\ArticlesController');

        ## Slides
        Route::resource('slides', 'Admin\SlidesController');

        ## Users
        Route::resource('users', 'Admin\UsersController');

        ## Administrators
        Route::resource('administrators', 'Admin\AdministratorsController');

        ## Sortable routes
        Route::post('sort', ['as' => 'sort', 'uses' => '\Rutorika\Sortable\SortableController@sort']);

        ## Imageable routes
        Route::delete('imageable', ['as' => 'imageable.delete', 'uses' => 'Admin\ImageableController@delete']);

        ## Photoable routes
        Route::post('photoable', ['as' => 'photoable.save', 'uses' =>'Admin\PhotoableController@savePhoto']);
        Route::delete('photoable/{id}', ['as' => 'photoable.delete', 'uses' => 'Admin\PhotoableController@deletePhoto'])->where('id', '[0-9]+');
    });
});


/* --------------------------------------------- App routes --------------------------------------------------------- */
Route::group([], function ()
{
    ## Authentication / Registration / Password Reset
    Route::auth();

    ## Index
    Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

    ## Search
    Route::get('/search', ['as' => 'search', 'uses' => 'SearchController@search']);

    # Feedback
    Route::get('feedback', ['as' => 'feedback', 'uses' => 'CommonController@feedback']);
    Route::post('feedback', ['as' => 'feedback.send', 'uses' => 'CommonController@feedbackSend']);

    ## Callback
    Route::post('callback', ['as' => 'callback', 'uses' => 'CommonController@callback']);

    ## Pages
    Route::get('page/{slug}', ['as' => 'page.show', 'uses' => 'PagesController@show']);

    ## News
    Route::get('news', ['as' => 'news', 'uses' => 'NewsController@index']);
    Route::get('news/{id}', ['as' => 'news.show', 'uses' => 'NewsController@show']);

    ## Articles
    Route::get('articles', ['as' => 'articles', 'uses' => 'ArticlesController@index']);
    Route::get('articles/{slug}', ['as' => 'articles.show', 'uses' => 'ArticlesController@show']);

    ## Galleries
    Route::get('galleries', ['as' => 'galleries', 'uses' => 'GalleriesController@index']);
    Route::get('galleries/{slug}', ['as' => 'galleries.show', 'uses' => 'GalleriesController@show']);

    ## Catalog
    Route::get('catalog', ['as' => 'catalog', 'uses' => 'CatalogController@index']); // index page
    Route::get('catalog/{category}', ['as' => 'catalog.category', 'uses' => 'CatalogController@category']); // category page
    Route::get('product/{product}', ['as' => 'catalog.product', 'uses' => 'CatalogController@product']); // product page

    ## Profile routes
    Route::group(['middleware' => 'auth'], function ()
    {
        Route::get('profile/personal', ['as' => 'profile.personal', 'uses' => 'ProfileController@personalShow']); // personal data
        Route::post('profile/personal', ['as' => 'profile.personal.save', 'uses' => 'ProfileController@personalSave']); // personal data save
        Route::get('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@passwordShow']); // change password form
        Route::post('profile/password', ['as' => 'profile.password.save', 'uses' => 'ProfileController@passwordSave']); // change password save
        Route::get('profile/orders', ['as' => 'profile.orders', 'uses' => 'ProfileController@orders']); // orders
        Route::get('profile/avatar', ['as' => 'profile.avatar', 'uses' => 'ProfileController@avatarShow']); // avatar
        Route::post('profile/avatar', ['as' => 'profile.avatar.save', 'uses' => 'ProfileController@avatarSave']); // avatar save
    });

    ## Social routes
    Route::get('auth/github', 'Auth\Social\GitHubAuthController@redirectToProvider');
    Route::get('auth/github/callback', 'Auth\Social\GitHubAuthController@handleProviderCallback');
    Route::get('auth/twitter', 'Auth\Social\TwitterAuthController@redirectToProvider');
    Route::get('auth/twitter/callback', 'Auth\Social\TwitterAuthController@handleProviderCallback');
    Route::get('auth/facebook', 'Auth\Social\FacebookAuthController@redirectToProvider');
    Route::get('auth/facebook/callback', 'Auth\Social\FacebookAuthController@handleProviderCallback');
    Route::get('auth/vkontakte', 'Auth\Social\VkontakteAuthController@redirectToProvider');
    Route::get('auth/vkontakte/callback', 'Auth\Social\VkontakteAuthController@handleProviderCallback');
    Route::get('auth/yandex', 'Auth\Social\YandexAuthController@redirectToProvider');
    Route::get('auth/yandex/callback', 'Auth\Social\YandexAuthController@handleProviderCallback');
    Route::get('auth/odnoklassniki', 'Auth\Social\OdnoklassnikiAuthController@redirectToProvider');
    Route::get('auth/odnoklassniki/callback', 'Auth\Social\OdnoklassnikiAuthController@handleProviderCallback');
    Route::get('auth/mailru', 'Auth\Social\MailRuAuthController@redirectToProvider');
    Route::get('auth/mailru/callback', 'Auth\Social\MailRuAuthController@handleProviderCallback');
    Route::get('auth/google', 'Auth\Social\GoogleAuthController@redirectToProvider');
    Route::get('auth/google/callback', 'Auth\Social\GoogleAuthController@handleProviderCallback');
});