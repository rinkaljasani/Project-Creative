<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    protected $fillable = [
    	'user_id',
    	'level'
    ];
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function languages()
    {
    	return $this->hasMany(Freelancerlanguage::class);
    }
    public function skills()
    {
    	return $this->hasMany(FreelancerSkill::class);
    }
    public function participants()
    {
    	return $this->hasMany(CompitititonParticipant::class);
    }
}
