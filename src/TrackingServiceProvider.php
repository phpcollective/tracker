<?php

namespace PhpCollective\Tracker;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class TrackingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Blueprint::macro('track', function (bool $usingSoftDelete = false) {
            Track::columns($this, $usingSoftDelete);
        });

        Blueprint::macro('dropTrack', function (bool $usingSoftDelete = false) {
            Track::dropColumns($this, $usingSoftDelete);
        });
    }
}