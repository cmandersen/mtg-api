<?php namespace API\MTG;

class Plane extends Card {

    protected $table = 'cards';

    protected $hidden = [
        'color',
        'created_at',
        'updated_at'
    ];

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->where("type", "LIKE", "Plane %");
    }
} 