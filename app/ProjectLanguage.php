<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectLanguage extends Model
{
    protected $fillable = [
    	'project_id',
    	'language_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
