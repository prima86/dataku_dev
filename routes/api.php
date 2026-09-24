<?php

use App\Http\Controllers\Api\TodoController;
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



Route::group(['prefix' => 'dss'], function () {
    Route::middleware(['CheckPrivilege'])->group(function () {
        Route::get('kode_tabel', 'Api_StatistikSektoralController@get_kode_tabel');
        Route::get('{kode_tabel}', 'Api_StatistikSektoralController@get_data');
        Route::get('{kode_tabel}/{tahun}', 'Api_StatistikSektoralController@get_data_by_year');
    });
});

Route::middleware(['CheckPrivilege'])->group(function () {
    Route::get('kode_kelurahan','Api_StatistikSektoralController@get_kode_kelurahan');

    Route::get('kode_kecamatan','Api_StatistikSektoralController@get_kode_kecamatan');

    Route::get('kode_opd','Api_StatistikSektoralController@get_kode_opd');

    Route::get('kode_golongan_asn','Api_StatistikSektoralController@get_kode_golongan_asn');

    Route::get('kode_agama','Api_StatistikSektoralController@get_kode_agama');

    Route::get('kode_bulan','Api_StatistikSektoralController@get_kode_bulan');
});