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


Route::get('/','PublicController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/announcement/new', 'HomeController@newAnnouncement')->name('announcement.new');
Route::post('/announcement/create', 'HomeController@createAnnouncement')->name('announcement.create');
Route::get('/announcement/{name}/{id}', 'HomeController@oneAnnouncement')->name('announcement.one'); 

Route::get('/category/{name}/{id}/announcements', 'PublicController@announcementsByCategory')->name('public.announcements.category');

Route::get('/revisor/home','RevisorController@index');

Auth::routes();
