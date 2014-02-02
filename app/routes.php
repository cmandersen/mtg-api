<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('prefix' => 'api'), function() {
	Route::group(array('prefix' => 'v1'), function() {
		Route::get('cards', 'CardsApiController@index');
		Route::get('cards/{id}', 'CardsApiController@show');
		Route::get('planes', 'PlanesApiController@index');
		Route::get('planes/{id}', 'PlanesApiController@show');

		Route::group(array('before' => array('auth.basic')), function() {
			Route::get('update', 'CardsApiController@updateDb');
		});
	});
});

