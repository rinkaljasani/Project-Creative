<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetitionData extends Model
{
    protected $fillable = [
    	'bid_id',// freelancer competition bid id
    	'data',
    	'freelancer_id'
    ];
      public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }
}
