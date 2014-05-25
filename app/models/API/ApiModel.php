<?php namespace API;

use Eloquent;

class ApiModel extends Eloquent {
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getIdAttribute($value)
    {
        return (int) $value;
    }
} 