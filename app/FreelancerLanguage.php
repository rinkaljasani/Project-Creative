<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FreelancerLanguage extends Model
{
    protected $fillable = [
    	'freelancer_id',
    	'language_id'
    ];
    
    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
