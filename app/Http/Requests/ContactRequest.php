<?php

namespace App\Http\Requests;

class ContactRequest extends JsonRequest
{
    const PHONE_REGEX = '/^\s*\+(\s*\(?\d\)?-?)*\s*$/x';
    const PHONE_NUMBER_MAX = 30;
    const COUNTRY_CODE_MAX = 2;
    const TIMEZONE_MAX = 30;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'phone_number' => 'required|max:' . self::PHONE_NUMBER_MAX . '|regex:' . self::PHONE_REGEX,
            'country_code' => 'countries|max:' . self::COUNTRY_CODE_MAX,
            'timezone' => 'timezones|max:' . self::TIMEZONE_MAX,
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'First name is required',
            'phone_number.required' => 'Phone number is required',
            'phone_number.regex' => 'Phone number must be valid number',
            'country_code.countries' => 'Country code is invalid',
            'timezone.timezones' => 'Timezone is invalid',
            'phone_number.max' => 'Max symbols for phone number is ' . self::PHONE_NUMBER_MAX,
            'country_code.max' => 'Max symbols for country code is ' . self::COUNTRY_CODE_MAX,
            'timezone.max' => 'Max symbols for timezone is ' . self::TIMEZONE_MAX,
        ];
    }
}
