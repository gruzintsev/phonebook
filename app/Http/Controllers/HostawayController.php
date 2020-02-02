<?php

namespace App\Http\Controllers;

use App\Services\Hostaway;

class HostawayController extends Controller
{
    public function countries()
    {
        return app(Hostaway::class)->getCountries();
    }

    public function timezones()
    {
        return app(Hostaway::class)->getTimezones();
    }
}
