<?php namespace API\MTG;

use API\ApiModel;

class Set extends ApiModel {
	public static $rules = [
        'title' => 'required',
        'code' => 'required',
        'release_date' => 'required',
        'type' => 'required'
    ];

    protected $fillable = [
        'title',
        'code',
        'gatherer_code',
        'release_date',
        'border',
        'type'
    ];

    public function cards()
    {
        return $this->hasMany('API\MTG\Card');
    }

    public function getReleaseDateAttribute($value)
    {
        return date('c', strtotime($value));
    }
}