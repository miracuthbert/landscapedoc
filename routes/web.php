<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Blog Resource Route
 */
Route::resource('/blog', 'Blog\PostController', [
    'only' => ['index', 'show']
]);

/**
 * Services Resource Route
 */
Route::group(['prefix' => '/services', 'namespace' => 'Service'], function () {

    /**
     * Service Booking Resource Routes
     */
    Route::group(['prefix' => '/{service}'], function () {
        Route::resource('/bookings', 'ServiceBookingController', [
            'only' => ['create', 'store', 'edit', 'update'],
            'names' => [
                'create' => 'service.booking.create',
                'store' => 'service.booking.store',
                'edit' => 'service.booking.edit',
                'update' => 'service.booking.update',
            ]
        ]);
    });
});

/**
 * Services Resource Route
 */
Route::resource('/services', 'Service\ServiceController', [
    'only' => ['index', 'show']
]);

/**
 * User Group Routes
 */
Route::group(['prefix' => '/user', 'namespace' => 'User'], function () {
    //show profile
    Route::get('/profile', 'ProfileShowController')->name('user.profile');

    //update profile
    Route::put('/profile/{user}', 'ProfileUpdateController')->name('user.update');
});

/**
 * Admin Group Routes
 */
Route::group(['prefix' => '/admin', 'namespace' => 'Admin'], function () {

    //show dashboard
    Route::get('/dashboard', 'DashboardController')->name('admin.dashboard');

    /**
     * Roles Group Route
     */
    Route::group(['prefix' => '/roles', 'namespace' => 'Role'], function () {

        //role users store route
        Route::post('/{role}/users', 'RoleUsersController@store')->name('admin.roles.users.store');

        //role users index route
        Route::get('/{role}/users', 'RoleUsersController@index')->name('admin.roles.users.index');

        //role users delete route
        Route::delete('/{role}/users/delete', 'RoleUsersController@destroy')->name('admin.roles.users.destroy');
    });

    /**
     * Roles Resource Route
     */
    Route::resource('roles', 'Role\RoleController', [
        'names' => [
            'index' => 'admin.roles.index',
            'create' => 'admin.roles.create',
            'store' => 'admin.roles.store',
            'show' => 'admin.roles.show',
            'edit' => 'admin.roles.edit',
            'update' => 'admin.roles.update',
            'destroy' => 'admin.roles.destroy',
        ]
    ]);

    /**
     * Users Resource Route
     */
    Route::resource('users', 'User\UserController', [
        'names' => [
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]
    ]);

    /**
     * Categories Resource Route
     */
    Route::resource('categories', 'Category\CategoryController', [
        'names' => [
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'show' => 'admin.categories.show',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]
    ]);

    /**
     * Areas Resource Route
     */
    Route::resource('areas', 'Area\AreaController', [
        'names' => [
            'index' => 'admin.areas.index',
            'create' => 'admin.areas.create',
            'store' => 'admin.areas.store',
            'show' => 'admin.areas.show',
            'edit' => 'admin.areas.edit',
            'update' => 'admin.areas.update',
            'destroy' => 'admin.areas.destroy',
        ]
    ]);

    /**
     * Posts Group Route
     */
    Route::group(['prefix' => '/posts', 'namespace' => 'Post'], function () {
        Route::group(['prefix' => '/{post}'], function () {

            /**
             * Comments Resource Route
             */
            Route::resource('comments', 'PostCommentController', [
                'only' => ['index', 'destroy'],
                'names' => [
                    'index' => 'admin.comments.index',
                    'edit' => 'admin.comments.edit',
                    'destroy' => 'admin.comments.destroy',
                ]
            ]);

        });
    });

    /**
     * Posts Resource Route
     */
    Route::resource('posts', 'Post\PostController', [
        'names' => [
            'index' => 'admin.posts.index',
            'create' => 'admin.posts.create',
            'store' => 'admin.posts.store',
            'show' => 'admin.posts.show',
            'edit' => 'admin.posts.edit',
            'update' => 'admin.posts.update',
            'destroy' => 'admin.posts.destroy',
        ]
    ]);

    /**
     * Services Resource Route
     */
    Route::group(['prefix' => '/services', 'namespace' => 'Service'], function () {

        /**
         * Service Booking Resource Routes
         */
        Route::group(['prefix' => '/{service}'], function () {
            Route::resource('/bookings', 'ServiceBookingController', [
                'only' => ['create', 'store', 'edit', 'update'],
                'names' => [
                    'index' => 'admin.services.bookings.index',
                    'store' => 'admin.services.bookings.store',
                    'edit' => 'admin.services.bookings.edit',
                    'update' => 'admin.services.bookings.update',
                ]
            ]);
        });
    });

    /**
     * Services Resource Route
     */
    Route::resource('services', 'Service\ServiceController', [
        'names' => [
            'index' => 'admin.services.index',
            'create' => 'admin.services.create',
            'store' => 'admin.services.store',
            'show' => 'admin.services.show',
            'edit' => 'admin.services.edit',
            'update' => 'admin.services.update',
            'destroy' => 'admin.services.destroy',
        ]
    ]);
});
