<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'breed',
        'name',
        'color',
        'date_of_birth',
        'status',
        'is_male',
        'registration_date',
        'leave_date',
        'location',
        'street',
        'city',
        'country',
        'is_castrated',
        'castration_date',
        'first_vaccination',
        'second_vaccination',
        'next_vaccination',
        'tattoo_left',
        'tattoo_right',
        'chip',
        'distinguishing_marks',
        'comments',
        'deceased',
        'cause_of_death',
        'is_indoor_cat',
        'is_outdoor_cat',
        'is_cat_friendly',
        'is_dog_friendly',
        'is_child_friendly',
        'photo_path'
    ];

    protected $casts = [
        'is_male' => 'boolean',
        'is_castrated' => 'boolean',
        'deceased' => 'boolean',
        'is_indoor_cat' => 'boolean',
        'is_outdoor_cat' => 'boolean',
        'is_cat_friendly' => 'boolean',
        'is_dog_friendly' => 'boolean',
        'is_child_friendly' => 'boolean'
    ];

    public function locations()
    {
        return $this->hasMany('App\Location');
    }
}
