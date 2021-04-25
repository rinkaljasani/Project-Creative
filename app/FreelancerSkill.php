<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreelancerSkill extends Model
{
    protected $fillable = [
    	'freelancer_id',
    	'skill_id'
    ];

    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }
    
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
