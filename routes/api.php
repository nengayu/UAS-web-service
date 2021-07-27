<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('password', function () {
    return bcrypt('ayu');
});

Route::get('berita','API\BeritaController@index');

Route::get('kategori', 'API\KategoriController@index');


// Add Berita
Route::post('berita', 'API\BeritaController@store');

// Update Berita
Route::patch('berita/{id}', 'API\BeritaController@update');

// Delete Berita
Route::delete('berita/{id}', 'API\BeritaController@destroy');


// Add Berita
Route::post('kategori', 'API\KategoriController@store');

// Update Berita
Route::patch('kategori/{id}', 'API\KategoriController@update');

// Delete Berita
Route::delete('kategori/{id}', 'API\KategoriController@destroy');


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::get('wajib', 'AuthController@wajib');

});

