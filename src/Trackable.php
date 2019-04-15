<?php

namespace PhpCollective\Tracker;


use PhpCollective\Tracker\Observers\Tracking;

trait Trackable
{
    public static function bootTrackable()
    {
        static::observe(new Tracking);
    }

    /**
     * Get the user who create the model.
     */
    public function creator()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'created_by');
    }

    /**
     * Get the user who delete the model.
     */
    public function destroyer()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'deleted_by');
    }

}