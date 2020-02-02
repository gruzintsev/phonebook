<?php

namespace App\Services;

interface TimezoneInterface
{
    /**
     * @return array
     */
    public function getTimezones(): array;
}