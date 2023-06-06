<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Frontend', 'as' => 'fe.'], function() {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/petunjuk-pendaftaran', 'HomeController@instruction')->name('instruction');

    Route::group(['prefix' => 'form-pendaftaran'], function() {
        Route::get('/zonasi', 'RegistrationController@zonasi')->name('registration.zonasi');
        Route::get('/prestasi', 'RegistrationController@prestasi')->name('registration.prestasi');

        Route::post('/store', 'RegistrationController@store')->name('registration.post');
        Route::post('/search', 'RegistrationController@search')->name('registration.search');
    });
    
    Route::get('/status-pendaftaran/{id}', 'RegistrationController@show')->name('registration.show');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'as' => 'be.'], function() {
    
    Route::group(['prefix' => 'auth'], function() {
        Route::get('/login', 'AuthController@showLogin')->name('auth.login');
        Route::post('/do-login', 'AuthController@doLogin')->name('auth.do-login');
        Route::get('/logout', 'AuthController@logout')->name('auth.logout');
    });

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', 'DashboardController@index')->name('index');

        Route::group(['prefix' => 'setting'], function() {
            Route::get('/', 'SettingController@index')->name('setting.index');
            Route::post('/update', 'SettingController@update')->name('setting.update');
            Route::post('/update-instruction', 'SettingController@updateInstruction')->name('setting.update-instruction');
        });

        Route::group(['prefix' => 'profile'], function() {
            Route::get('/', 'UserController@indexProfile')->name('profile.index');
            Route::patch('/{id}', 'UserController@updateProfile')->name('profile.update');
        });

        Route::group(['prefix' => 'user', 'middleware' => 'role:superadmin'], function() {
            Route::get('/', 'UserController@index')->name('user.index');
            Route::get('/json', 'UserController@json')->name('user.json');
            Route::post('/store', 'UserController@store')->name('user.store');
            Route::get('/{id}', 'UserController@show')->name('user.show');
            Route::post('/update', 'UserController@update')->name('user.update');
            Route::delete('/{id}', 'UserController@delete')->name('user.delete');
        });

        Route::group(['prefix' => 'ppdb'], function() {
            Route::get('/', 'RegistrationController@index')->name('ppdb.index');
            Route::get('/json', 'RegistrationController@json')->name('ppdb.json');
            Route::get('/{id}', 'RegistrationController@show')->name('ppdb.show');
            Route::post('/update', 'RegistrationController@update')->name('ppdb.update');
            Route::post('/make-zip', 'RegistrationController@makeZip')->name('ppdb.makezip');
            Route::get('/download/{file}', 'RegistrationController@download')->name('ppdb.download');
        });

        Route::group(['prefix' => 'activity-log', 'middleware' => 'role:superadmin'], function() {
            Route::get('/', 'ActivityLogController@index')->name('activity.index');
            Route::get('/json', 'ActivityLogController@json')->name('activity.json');
        });
    });
});