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

Route::get('/', function () {
    return redirect(\route('balance'));
});

// Auth routes
Route::namespace('App\Http\Controllers\Auth')->group(function () {
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'RegisterController@register');

    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');

    Route::post('/logout', 'LoginController@logout')->name('logout');
});

Route::group(['middleware' => 'auth', 'namespace' => 'App\Http\Controllers'],function () {
    Route::get('/balance', 'BalanceController@show')->name('balance');
    Route::get('/balance/top-up', 'BalanceController@topUpForm')->name('balance.form');
    Route::post('/balance/top-up', 'BalanceController@topUp')->name('balance.store');

    Route::get('/deposit', 'DepositController@index')->name('deposit.index');
    Route::get('/deposit/top-up', 'DepositController@create')->name('deposit.create');
    Route::post('/deposit/top-up', 'DepositController@store')->name('deposit.store');

    Route::get('/transactions', 'Transactions@index')->name('transactions.index');
});

