<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('auth/login', 'Auth\AuthController@getLogin');
/*Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
*/




Route::get('confirmation/{token}', 'Auth\AuthController@getConfirmation')->name('confirmation');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/




Route::group(['middleware' => 'web'], function () {

    //rutas de login reset logout etc etc
    Route::auth();

    Route::get('/login', function(){
        return view('auth/login');
    });

    Route::get('/',[
            'uses' => 'PostController@listapublica',
            'as' => 'posts'
        ]);

    Route::get('/home',[
            'uses' => 'PostController@listapublica',
            'as' => 'posts'
        ]);

    Route::get('/posts',[
            'uses' => 'PostController@listapublica',
            'as' => 'posts'
        ]);




    Route::group(['middleware' => 'auth'], function () {

        # RUTAS 

        Route::resource('admin/users', 'PostController');

        # ademas de iniciar sesión debe tner una cuenta verificada

        Route::resource('publish', 'PostController');

        

        Route::resource('admin/posts', 'PostController');

        Route::delete('admin/posts/delete/{id}', [
            'as' => 'admin/posts/delete',
            'uses' => 'PostController@delete'
        ]);

        

        # ademas de iniciar sesión debe tner una cuenta verificada
        Route::group(['middleware' => 'role:admin'], function(){
        });
        # ademas de iniciar sesión debe tner una cuenta verificada
        Route::group(['middleware' => 'role:editor'], function(){
        });
        # rutas exclusivas de usuarios verificados
        Route::group(['middleware' => 'verified'], function(){
        });


        Route::get('account', function(){
            return view('admin/account');
        });

        Route::get('admin/settings', function(){
            return view('admin/settings');
        });

        Route::get('account/password', 'AccountController@getPassword');
        Route::post('account/password', 'AccountController@postPassword');
        Route::get('account/edit-profile', 'AccountController@editProfile');
        Route::put('account/edit-profile', 'AccountController@updateProfile');
    
    });
        
    
});
