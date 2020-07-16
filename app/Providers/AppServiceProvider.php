<?php

namespace App\Providers;

use App\Services\Cache;
use App\Services\ContactService;
use App\Services\Hostaway;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            Hostaway::class,
            function (Application $app) {
                return new Hostaway();
            }
        );

        $this->app->bind(
            ContactService::class,
            function (Application $app) {
                return new ContactService();
            }
        );

        $this->app->bind(
            Cache::class,
            function (Application $app) {
                return new Cache($app->make(Redis::class));
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('phone', '\App\Helpers\Validator\HostawayValidator@phone');
        Validator::extend('countries', '\App\Helpers\Validator\HostawayValidator@countries');
        Validator::extend('timezones', '\App\Helpers\Validator\HostawayValidator@timezones');

        Builder::macro('orWhereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                }
            });

            return $this;
        });
    }
}
