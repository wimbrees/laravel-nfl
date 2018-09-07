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

Auth::routes();

Route::get('/test', 'TestController@test');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/standings', 'HomeController@standings')->name('standings');
Route::get('/my-achievements', 'HomeController@myAchievements')->name('standings');

Route::post('/bets', 'BetsController@store');
Route::delete('/bets/{bet}', 'BetsController@destroy');

Route::middleware('admin')->group(function () {
    Route::get('/odds', 'BackendController@odds');
    Route::post('/odds', 'BackendController@oddsStore');
    Route::get('/scores', 'BackendController@scores');
    Route::post('/scores', 'BackendController@scoresStore');
    Route::get('/achievements', 'BackendController@achievements');
    Route::post('/achievements', 'BackendController@achievementsStore');
});

Route::get('/{any}', function () {
    return redirect()->route('home');
})->where('any', '.*');
