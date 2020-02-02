<?php

namespace App\Services;

interface CountryInterface
{
    /**
     * @return array
     */
    public function getCountries(): array;
}