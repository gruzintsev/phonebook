<?php

namespace Tests\Feature;

use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class HostawayTest extends TestCase
{
    public function testsCountries()
    {
        $this->getJson(route('hostaway_countries'))
            ->assertStatus(JsonResponse::HTTP_OK)
        ;
    }

    public function testsTimezones()
    {
        $this->getJson(route('hostaway_timezones'))
            ->assertStatus(JsonResponse::HTTP_OK)
        ;
    }
}
