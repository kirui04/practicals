<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
