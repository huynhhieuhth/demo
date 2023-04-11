<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'Auth\RegisterController@index')->name('register.index');
        Route::post('/register', 'Auth\RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'Auth\LoginController@index')->name('login.index');
        Route::post('/login', 'Auth\LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'Auth\LogoutController@perform')->name('logout.perform');
    });

    Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
        Route::get('/dashboard', 'admin\HomeController@index')->name('admin.index');
    });
});
