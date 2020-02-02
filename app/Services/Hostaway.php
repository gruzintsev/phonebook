<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Hostaway implements CountryInterface, TimezoneInterface
{
    const URL = 'https://api.hostaway.com/';
    const COUNTRIES = 'countries';
    const TIMEZONES = 'timezones';

    const REQUEST_TIMEOUT = 5;

    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => static::URL,
            'timeout' => static::REQUEST_TIMEOUT
        ]);

        $this->cache = app(Cache::class);
    }

    /**
     * @return array
     */
    public function getCountries(): array
    {
        if ($countries = $this->cache->getCountries()) {
            return $countries;
        }

        try {
            $countries = $this->getResult(self::COUNTRIES);
            $this->cache->saveCountries($countries);
        } catch (\Exception $e) {
            $countries = [];
            Log::error('Getting countries from ' . self::URL . ' : ' . $e->getMessage());
        }

        return $countries;
    }

    /**
     * @return array
     */
    public function getTimezones(): array
    {
        try {
            $timezones = $this->getResult(self::TIMEZONES);
        } catch (\Exception $e) {
            $timezones = [];
            Log::error('Getting timezones from ' . self::URL . ' : '. $e->getMessage());
        }

        return $timezones;
    }

    /**
     * @param string $uri
     * @return array
     * @throws \Exception
     */
    private function getResult(string $uri): array
    {
        $response = $this->client->get($uri);
        $response = json_decode($response->getBody()->getContents(), true);
        if ($response['status'] != 'success') {
            throw new \Exception('Response with status: ' . $response['status']);
        }

        return $response['result'];
    }
}
