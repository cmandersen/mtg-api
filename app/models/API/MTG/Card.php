<?php namespace API\MTG;

use API\ApiModel;

class Card extends ApiModel {
	protected $guarded = [];

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
		'set_id' => 'required'
	);

    public function set()
    {
        return $this->belongsTo('API\MTG\Set');
    }

    public function getPowerAttribute($value)
    {
        return (int) $value;
    }

    public function getToughnessAttribute($value)
    {
        return (int) $value;
    }

    public function getSetIdAttribute($value)
    {
        return (int) $value;
    }

    public function getColorAttribute($value)
    {
        return json_decode($value);
    }
}
