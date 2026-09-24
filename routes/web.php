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
    return view('home');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('sitemap.xml', function () {
    return view('sitemap');
});
Auth::routes();

Route::get('remove_cookie/{cookie_name}', function ($cookie_name) {
	return Cookie::queue(Cookie::forget($cookie_name));
});
Route::get('set_night_mode/{night_mode}', function ($night_mode) {
	return Cookie::queue(Cookie::forever('night_mode', $night_mode));
});

Route::group(['prefix' => 'integration'], function () {
  Route::get('harga', 'HargaController@index');
});

Route::group(['prefix' => 'grafik'], function () {
  Route::get('get_data/{dss_url}', 'GrafikController@get_data');
  // Route::get('get_list/{id_category}', 'GrafikController@get_list');
});

Route::group(['prefix' => 'dss'], function () {
	Route::get('/', 'StatistikSektoralController@index');
  Route::get('index', 'StatistikSektoralController@index');
  Route::post('set_dss_global_year', 'StatistikSektoralController@setDssGlobalYear');
  // Route::get('grafiks', 'StatistikSektoralController@grafiks');
    

    //------------------------BAB 5---------------------------------

    // Banyaknya Bayi Lahir dan Bayi Gizi Buruk
    Route::group(['prefix' => 'dss_5_1'], function () {
      Route::get('/', 'Dss\Dss_5_1_Controller@view');
      Route::get('view', 'Dss\Dss_5_1_Controller@view');
      Route::get('get_data_by_year/{year}', 'Dss\Dss_5_1_Controller@get_data_by_year');
      Route::middleware(['CheckPrivilege'])->group(function () {
        Route::post('store', 'Dss\Dss_5_1_Controller@store');
        Route::post('delete', 'Dss\Dss_5_1_Controller@delete');
        Route::post('set_verification', 'Dss\Dss_5_1_Controller@setVerification');
        Route::post('set_publish', 'Dss\Dss_5_1_Controller@setPublish');
      });
    });

    // Banyaknya Puskesmas, RS/Klinik Bersalin, Klinik, Pustu dan Balai Pengobatan
    Route::group(['prefix' => 'dss_5_2'], function () {
      Route::get('/', 'Dss\Dss_5_2_Controller@view');
      Route::get('view', 'Dss\Dss_5_2_Controller@view');
      Route::get('get_data_by_year/{year}', 'Dss\Dss_5_2_Controller@get_data_by_year');
      Route::middleware(['CheckPrivilege'])->group(function () {
        Route::post('store', 'Dss\Dss_5_2_Controller@store');
        Route::post('delete', 'Dss\Dss_5_2_Controller@delete');
        Route::post('set_verification', 'Dss\Dss_5_2_Controller@setVerification');
        Route::post('set_publish', 'Dss\Dss_5_2_Controller@setPublish');
      });
    });
});
