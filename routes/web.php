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
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/test', 'URLController@index');

Route::post('/shorten-url', 'URLController@shorten')->name('shorten');

Route::get('/u/{id}', 'URLController@url');
Route::get('/u/{id}/edit', 'URLController@edit');
Route::post('/u/{id}/edit', 'URLController@update');
Route::post('/u/{id}/toggle', 'URLController@toggle');

// test
use Jenssegers\Agent\Agent;
Route::get('/test', function(){
    // $agent = new Agent();
    // $device = $agent->platform();
    // return $device;
    $url = 'https://www.amazon.in/Test-Exclusive-628/dp/B07HGMQX6N/ref=br_msw_pdt-1?_encoding=UTF8&smid=A1EWEIV3F4B24B&pf_rd_m=A1VBAL9TL5WCBF&pf_rd_s=&pf_rd_r=G3J2FRR80M0CR3BJA3X1&pf_rd_t=36701&pf_rd_p=42395646-6111-4052-9461-7fbeaaa65425&pf_rd_i=desktop';
    
     $fp = file_get_contents($url);
        if (!$fp) 
            return null;

        $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
        if (!$res) 
            return null; 

        // Clean up title: remove EOL's and excessive whitespace.
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
        return $title;
});

// API routes
Route::post('/api/{id}', 'URLController@chart');

// Goes Last 
Route::get('/{id}', 'URLController@redirect');