<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetitionFreelancer extends Model
{
    protected $fillable = [
    	'competition_id',
    	'freelancer_id',
    	'isAssinged',
    ];
    public function freelancer(){
    	return $this->belongsTo(Freelancer::class);
    }
    public function competition(){
    	return $this->belongsTo(ProjectCompetition::class);
    }
}
