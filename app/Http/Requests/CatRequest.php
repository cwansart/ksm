<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'color' => 'required',

            'date_of_birth' => 'nullable|date',
            'registration_date' => 'nullable|date',
            'leave_date' => 'nullable|date',
            'castration_date' => 'nullable|date',
            'first_vaccination' => 'nullable|date',
            'second_vaccination' => 'nullable|date',
            'next_vaccination' => 'nullable|date',
            
            'tattoo_left' => 'string|max:5|nullable',
            'tattoo_right' => 'string|max:5|nullable',

            'chip' => 'integer|nullable',

            'is_male' => 'boolean',
            'is_castrated' => 'boolean',
            'deceased' => 'boolean',
            'is_indoor_cat' => 'boolean',
            'is_outdoor_cat' => 'boolean',
            'is_cat_friendly' => 'boolean',
            'is_dog_friendly' => 'boolean',
            'is_child_friendly' => 'boolean',

            'image' => 'image64:jpeg,jpg,png'
        ];
    }
}
