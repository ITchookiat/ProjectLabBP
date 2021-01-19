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

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function()
  {
    //------------------Admin--------------------//
    Route::get('/maindata/register', 'UserController@register')->name('regist');
    Route::post('/maindata/saveregister', 'UserController@Saveregister')->name('Saveregist');
    Route::get('/maindata/view', 'UserController@index')->name('ViewMaindata');
    Route::get('/maindata/edit/{id}', 'UserController@edit')->name('maindata.edit');
    Route::patch('/maindata/update/{id}', 'UserController@update')->name('maindata.update');
    Route::delete('/maindata/delete/{id}', 'UserController@destroy')->name('maindata.destroy');

    //------------------งานอู่สี--------------------//
    route::resource('MasterBP','BodyPaintController');
    // Route::get('/Regis/Home/{type}', 'RegisController@index')->name('Regis');

    //---------------- logout --------------------//
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/{name}', 'HomeController@index')->name('index');

  });
