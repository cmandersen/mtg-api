<?php

Route::group(array('prefix' => 'api'), function() {
	Route::group(array('prefix' => 'v1'), function() {
		Route::post('login', 'UsersApiController@login');

		Route::get('users', 'UsersApiController@index');
		Route::get('users/{id}', 'UsersApiController@show');

		Route::get('cards', 'CardsApiController@index');
		Route::get('cards/{id}', 'CardsApiController@show');

		// You need to be logged in before being able to CUD users, or update the cards table.
		Route::group(array('before' => 'auth.basic'), function() {
			Route::post('users', 'UsersApiController@store');
			Route::post('users/{id}', 'UsersApiController@update');
			Route::delete('users/{id}', 'UsersApiController@destroy');

			Route::get('cards/updatedb', 'CardsApiController@updateDb');
		});
	});
});