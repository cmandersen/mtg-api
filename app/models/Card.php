<?php

class Card extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'title' => 'required',
		'mana' => 'required',
		'type' => 'required',
		'text' => 'required',
		'flavor' => 'required',
		'power' => 'required',
		'toughness' => 'required',
		'rarity' => 'required',
		'image' => 'required',
		'color' => 'required',
		'set' => 'required'
	);

	public function updateDb() 
	{
		set_time_limit(0);
		$this->truncate();
		$groups = $this->getJsonFile('http://mtgjson.com/json/AllSets-x.json');

		foreach($groups as $group) {
			foreach($group->cards as $card) {
				$db = $this->firstOrNew(array("id" => $card->multiverseid));

				$db->fill(array(
					"id" => $card->multiverseid,
					"title" => isset($card->name) ? $card->name : "",
					"mana" => isset($card->manaCost) ? $card->manaCost : "",
					"type" => isset($card->type) ? $card->type : "",
					"text" => isset($card->text) ? $card->text : "",
					"flavor" => isset($card->flavor) ? $card->flavor : "",
					"power" => isset($card->power) ? $card->power : 0,
					"toughness" => isset($card->toughness) ? $card->toughness : 0,
					"rarity" => isset($card->rarity) ? $card->rarity : "",
					"image" => "http://mtgimage.com/multiverseid/" . $card->multiverseid . ".jpg",
					"color" => isset($card->colors) ? json_encode($card->colors) : "",
					"set" => $group->name
				));

				$db->save();
			}
		}
	}

	public function getJsonFile($path)
	{
		ini_set('memory_limit', '-1');
		$groups = $this->getRemote($path);
		return json_decode($groups);
	}

	public function getRemote($path) 
	{
		return file_get_contents($path);
	}
}
