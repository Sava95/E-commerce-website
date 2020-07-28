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
Route::get('/announcement/new', 'HomeController@newAnnouncement')->name('announcement.new'); //make new announcement
Route::post('/announcement/create', 'HomeController@createAnnouncement')->name('announcement.create'); //function for saving ads
Route::get('/announcement/{name}/{id}', 'HomeController@oneAnnouncement')->name('announcement.one'); //details of one announcement

Route::get('/category/{name}/{id}/announcements', 'PublicController@announcementsByCategory')->name('public.announcements.category'); //view ads that are in one category


/* Revisor rutes  */
Route::get('/revisor/home', 'RevisorController@index')->name('revisor.home');
Route::post('/revisor/announcement/{id}/accept', 'RevisorController@accept')->name('revisor.accept');
Route::post('/revisor/announcement/{id}/reject', 'RevisorController@reject')->name('revisor.reject');

Auth::routes();
