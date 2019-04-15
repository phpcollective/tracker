<?php

namespace PhpCollective\Tracker\Observers;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Tracking
{
    /**
     * Listen to the Model creating event.
     *
     * @param  Model $model
     * @return void
     */
    public function creating(Model $model)
    {
        if (Auth::check())
        {
            $model->created_by = Auth::id();
        }
    }

    /**
     * Listen to the Model deleting event.
     *
     * @param  Model $model
     * @return void
     */
    public function deleted(Model $model)
    {
        if (Auth::check())
        {
            $model->deleted_by = Auth::id();
            $model->save();
        }
    }

    /**
     * Listen to the Model deleting event.
     *
     * @param  Model $model
     * @return void
     */
    public function restoring(Model $model)
    {
        $model->deleted_by = null;
        $model->save();
    }
}