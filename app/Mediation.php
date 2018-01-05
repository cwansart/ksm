<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mediation extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'location'
    ];

    public function cat()
    {
        return $this->belongsTo('App\Cat');
    }
}
