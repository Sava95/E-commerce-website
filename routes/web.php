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
Route::get('/welcome','PublicController@welcome')->name('welcome');  // welcome page
Route::get('/search', 'PublicController@search')->name('search'); // seach for list of announcements page

// Home Controller
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/announcement/new', 'HomeController@newAnnouncement')->name('announcement.new'); //make new announcement
Route::post('/announcement/create', 'HomeController@createAnnouncement')->name('announcement.create'); //function for saving ads
Route::get('/announcement/{name}/{id}', 'HomeController@oneAnnouncement')->name('announcement.one'); //details of one announcement

// Dropzone
Route::post('/announcement/images/upload', 'HomeController@uploadImages')->name('announcement.images.upload'); // dropzone
Route::delete('/announcement/images/remove', 'HomeController@removeImages')->name('announcement.images.remove'); //delete upload img
Route::get('/announcement/images', 'HomeController@getImages')->name('announcement.images'); // 

Route::get('/category/{name}/{id}/announcements', 'PublicController@announcementsByCategory')->name('public.announcements.category'); //view ads that are in one category

// Revisor rutes  
Route::get('/revisor/home', 'RevisorController@index')->name('revisor.home');
Route::post('/revisor/announcement/{id}/accept', 'RevisorController@accept')->name('revisor.accept');
Route::post('/revisor/announcement/{id}/reject', 'RevisorController@reject')->name('revisor.reject');

// Language routes
Route::post('/locale/{locale}', 'PublicController@locale')->name('locale');

Auth::routes();
