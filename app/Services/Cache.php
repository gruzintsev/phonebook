<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class Cache implements CountryInterface, TimezoneInterface
{
    const TIMEZONES = 'timezones';
    const COUNTRIES = 'countries';
    const TIME = 3600;

    /**
     * @return array
     */
    public function getCountries(): array
    {
        return json_decode(Redis::get(self::COUNTRIES), true) ?: [];
    }

    /**
     * @return array
     */
    public function getTimezones(): array
    {
        return json_decode(Redis::get(self::TIMEZONES), true) ?: [];
    }

    /**
     * @param array $countries
     * @return mixed
     */
    public function saveCountries(array $countries)
    {
        return json_decode(Redis::set(self::COUNTRIES, json_encode($countries), 'EX', self::TIME), true);
    }

    /**
     * @param array $timezones
     * @return mixed
     */
    public function saveTimezones(array $timezones)
    {
        return json_decode(Redis::set(self::TIMEZONES, json_encode($timezones), 'EX', self::TIME), true);
    }
}