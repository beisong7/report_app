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

Route::get('/', 'HomeController@index')->name('home');
Route::get('unfiltered', 'HomeController@unfiltered')->name('unfiltered');
Route::post('save/phone', 'PhoneController@store')->name('save.phone');
Route::post('save/email', 'EmailController@store')->name('save.email');


Route::get('phone/', 'PhoneController@phones')->name('phone');
Route::get('import', 'ImportController@import')->name('import');
Route::post('import', 'ImportController@startImport')->name('start.import');

//deleting records
Route::get('delete/entry', 'ImportController@deleteEntry');
Route::get('update/old/entry', 'ImportController@updateOldRecords');
Route::post('update/entry/update', 'PhoneController@updateUnfiltered')->name('update.unfiltered');

Route::get('email/', 'EmailController@emails')->name('email');

Route::get('phone/edit/{id}', 'PhoneController@phonesEdit')->name('phone.edit');
Route::post('phone/edit/{id}', 'PhoneController@phonesUpdate')->name('phone.edit');

Route::get('email/edit/{id}', 'EmailController@emailsEdit')->name('email.edit');
Route::post('email/edit/{id}', 'EmailController@emailsUpdate')->name('email.edit');

Route::get('resolve-case-action', 'ActionController@toggleState')->name('toggle.case');

Route::get('export/excel/{type}', 'ExportController@exportData')->name('export.excel');
