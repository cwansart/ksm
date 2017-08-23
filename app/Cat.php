<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $fillable = [
        'breed',
        'name',
        'color',
        'date_of_birth',
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
}
