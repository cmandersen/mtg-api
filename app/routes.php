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
/**
 * MODELS
 */
Route::model('card', 'API\MTG\Card');
Route::model('plane', 'API\MTG\Plane');
Route::model('set', 'API\MTG\Set');

/**
 * MTG API
 */
Route::group(array('prefix' => 'api', 'namespace' => 'API\MTG'), function() {
	Route::group(array('prefix' => 'v1'), function() {
        Route::get('sets', 'SetsController@index');
        Route::get('sets/{set}', 'SetsController@show');
        Route::get('sets/{set}/cards', 'SetsController@cardsIndex');

		Route::get('cards', 'CardsController@index');
		Route::get('cards/{card}', 'CardsController@show');

		Route::get('planes', 'PlanesController@index');
		Route::get('planes/{plane}', 'PlanesController@show');
	});
});

