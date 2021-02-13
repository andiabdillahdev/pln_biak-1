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

Route::get('/', 'agentController@index_agent');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/agent', 'agentController@index_agent')->name('agent.home');
Route::get('/agent/register','agentController@agent_register')->name('agent.regis');
Route::post('/agent/daftar', 'agentController@daftar_agent')->name('agent.daftar');
Route::get('/agent_logout', 'agentController@logout')->name('agent.logout');
Route::post('/agent/setrek', 'agentController@setrek');
Route::post('/agent/updateakun', 'agentController@updateakunagent');
Route::get('/admin/laporan', 'HomeController@laporan');
Route::get('/admin/data-agent', 'HomeController@dataagent');
Route::post('/admin/updateakunagent', 'HomeController@edtakunagent');
Route::post('/admin/updateprogress', 'HomeController@updateprogress');
Route::post('/admin/updateakun', 'HomeController@updateakun');
Route::get('/admin/hapuslaporan/{id}', 'HomeController@hapuslaporan');
Route::get('/admin/getmedia/{id}', 'HomeController@getMedia');
Route::get('/laporan/serverside', 'HomeController@laporanServerside');
Route::get('/admin/reward', 'HomeController@reward');
Route::post('/admin/setreward', 'HomeController@setreward');
Route::post('/admin/updatestatusreward', 'HomeController@updatestatusreward');
Route::get('/admin/hapusreward/{id}', 'HomeController@hapusreward');
Route::get('/admin/getagentajx', 'HomeController@getagentajx');
Route::post('/createlaporan', 'agentController@createlaporan');
Route::post('/file-upload', 'agentController@upload');
