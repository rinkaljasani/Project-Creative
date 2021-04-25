<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
    	'user_id',
    	'name',
    	'detail',
    	'budget',
    	'total_days',
    	'total_hours',
    	'level'
    ];
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function languages()
    {
    	return $this->hasMany(ProjectLanguage::class);
    }
    public function skills()
    {
    	return $this->hasMany(ProjectSkill::class);
    }
    public function competitions()
    {
    	return $this->hasMany(ProjectCompetition::class);
    }
}
