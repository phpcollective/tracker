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
        return $this->belongsTo(
            config('auth.providers.users.model'), Track::CREATED_BY
        )->withDefault();
    }

    /**
     * Get the user who modify the model.
     */
    public function editor()
    {
        return $this->belongsTo(
            config('auth.providers.users.model'), Track::UPDATED_BY
        )->withDefault();
    }

    /**
     * Get the user who delete the model.
     */
    public function destroyer()
    {
        return $this->belongsTo(config('auth.providers.users.model'), Track::DELETED_BY);
    }

    /**
     * Get the name of the "created by" column.
     *
     * @return string
     */
    public function getCreatedByColumn()
    {
        return Track::CREATED_BY;
    }

    /**
     * Get the name of the "updated by" column.
     *
     * @return string
     */
    public function getUpdatedByColumn()
    {
        return Track::UPDATED_BY;
    }

    /**
     * Get the name of the "deleted by" column.
     *
     * @return string
     */
    public function getDeletedByColumn()
    {
        return Track::DELETED_BY;
    }
}