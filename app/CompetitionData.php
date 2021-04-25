<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetitionData extends Model
{
    protected $fillable = [
    	'bid_id',// freelancer competition bid id
    	'data',
    ];
}
