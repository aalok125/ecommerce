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

Route::prefix('mediaupload')->group(function() {
    Route::get('/upload', 'MediaUploadController@mediaupload')->name('upload');
    Route::get('/delete/{id}', 'MediaUploadController@destroy')->name('filedelete');
    Route::get('/filesupload', 'MediaUploadController@filesupload')->name('filesupload');
    Route::post('/filesubmit', 'MediaUploadController@filesubmit')->name('filesubmit');
    Route::post('/search', 'MediaUploadController@search')->name('search');
});
