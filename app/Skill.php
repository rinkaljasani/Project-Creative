<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
    	'skill',
    	'discription',
    	'image',
    ];
     public function getSkillAttribute($value)
    {
        return strtoupper($value);
    }
}
