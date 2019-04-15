<?php

namespace PhpCollective\Tracker\Observers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Tracking
{
    protected $auth_id;

    public function __construct()
    {
        if (! Auth::check()) {
            return false;
        }

        $this->auth_id = Auth::id();
    }

    /**
     * Listen to the Model creating event.
     *
     * @param  Model $model
     * @return void
     */
    public function creating(Model $model)
    {
        $model->{$model->getCreatedByColumn()} = $this->auth_id;
    }

    public function updated(Model $model)
    {
        DB::table($model->getTable())
            ->where($model->getKeyName(), $model->{$model->getKeyName()})
            ->update([$model->getUpdatedByColumn() => $this->auth_id]);
    }

    /**
     * Listen to the Model deleting event.
     *
     * @param  Model $model
     * @return void
     */
    public function deleted(Model $model)
    {
        if(isset($model->{$model->getDeletedByColumn()}))
        {
            $model->{$model->getDeletedByColumn()} = $this->auth_id;
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
        if(isset($model->{$model->getDeletedByColumn()}))
        {
            $model->{$model->getUpdatedByColumn()} = $this->auth_id;
            $model->{$model->getDeletedByColumn()} = null;
            $model->save();
        }
    }
}