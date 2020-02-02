<?php

namespace App\Http\Requests;

class ContactUpdateRequest extends ContactRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        unset($rules['first_name']);
        $rules['phone_number'] = str_replace('required|', '', $rules['phone_number']);

        return $rules;
    }

}
