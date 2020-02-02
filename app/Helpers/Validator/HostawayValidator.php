<?php

namespace App\Helpers\Validator;

use App\Services\Hostaway;

class HostawayValidator
{
    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public static function countries($attribute, $value, $parameters, $validator)
    {
        return array_key_exists($value, app(Hostaway::class)->getCountries());
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public static function timezones($attribute, $value, $parameters, $validator)
    {
        return array_key_exists($value, app(Hostaway::class)->getTimezones());
    }
}