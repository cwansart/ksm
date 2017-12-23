<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'location'
    ];

    public function cat()
    {
        return $this->belongsTo('App\Cat');
    }
}
