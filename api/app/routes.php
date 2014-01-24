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

Route::group(array("prefix" => "v1"), function() {
	Route::post("login", function() {
		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if(Auth::attempt($credentials)) {
			return Response::json(['user' => Auth::user()->toArray()], 200);
		} else {
			return Response::json(['message' => 'Invalid username or password'], 401);
		}
	});

	Route::get("cards", function() {
		ini_set('memory_limit', '-1');

		$search = Input::get('name');
		$limit = Input::get('limit', PHP_INT_MAX);
		$offset = Input::get('offset', 0);

		$cards = Card::take($limit)->offset($offset)->orderBy("name", "ASC")->where('name', 'LIKE', '%'. $search .'%')->get();

		return Response::json($cards, 200);
	});

	Route::get("cards/{id}", function($id) {
		$card = Card::find($id);

		return Response::json($card, 200);
	})->where("id", "\d+");

	Route::get("/planes", function() {
		$random = Input::get("randomize", false);

		$planes = Card::where("type", "LIKE", "Plane %")->orderBy($random ? DB::raw('RAND()') : "name")->get();

		return Response::json($planes, 200);
	});

	Route::get("planes/{id}", function($id) {
		$plane = Card::find($id);

		return Response::json($plane, 200);
	})->where("id", "\d+");

	Route::get("update", function() {
		ini_set('memory_limit', '-1');
		set_time_limit(0);
		Eloquent::unguard();

		$groups = file_get_contents("http://mtgjson.com/json/AllSets-x.json");
		$groups = json_decode($groups);

		foreach($groups as $group) {
			foreach($group->cards as $card) {
				$db = Card::firstOrCreate(array("id" => $card->multiverseid));

				$db->save();

				$db->update(array(
					"id" => $card->multiverseid,
					"name" => isset($card->name) ? $card->name : "",
					"mana" => isset($card->manaCost) ? $card->manaCost : "",
					"type" => isset($card->type) ? $card->type : "",
					"text" => isset($card->text) ? $card->text : "",
					"flavor" => isset($card->flavor) ? $card->flavor : "",
					"power" => isset($card->power) ? $card->power : 0,
					"toughness" => isset($card->toughness) ? $card->toughness : 0,
					"rarity" => isset($card->rarity) ? $card->rarity : "",
					"image" => "http://mtgimage.com/set/" . $group->code . "/" . $card->imageName . ".jpg",
					"color" => isset($card->colors) ? json_encode($card->colors) : "",
					"set" => $group->name
				), true);
			}
		}

		return Response::json([], 204);
	});
});