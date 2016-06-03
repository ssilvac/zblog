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



Route::group(['middleware' => ['web']], function () {

    

});



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

    Route::get('/posts',[
            'uses' => 'PostController@listapublica',
            'as' => 'posts'
        ]);
    


    Route::group(['middleware' => 'auth'], function () {

        # RUTAS 

        Route::resource('admin/users', 'PostController');

        # ademas de iniciar sesión debe tner una cuenta verificada


        Route::group(['middleware' => 'verified'], function(){


            Route::resource('publish', 'PostController');
            
            /*
            Route::get('publish', function(){
                return view('publish');
            });

            Route::post('publish', function(){
                return dd(Request::all())  ;
            });
            */

        });


        # ademas de iniciar sesión debe tner una cuenta verificada
        Route::group(['middleware' => 'role:admin'], function(){

            Route::get('admin/settings', function(){
                return view('admin/settings');
            });

        });

        # ademas de iniciar sesión debe tner una cuenta verificada
        Route::group(['middleware' => 'role:editor'], function(){

            Route::get('admin/posts', [
                'uses' => 'PostController@index',
                'as' => 'posts'
            ]);

        });

        Route::get('account', function(){
            return view('admin/account');
        });

        Route::get('account/password', 'AccountController@getPassword');
        Route::post('account/password', 'AccountController@postPassword');
        Route::get('account/edit-profile', 'AccountController@editProfile');
        Route::put('account/edit-profile', 'AccountController@updateProfile');
    
    });
        
    
});
