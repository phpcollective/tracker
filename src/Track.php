<?php

namespace PhpCollective\Tracker;

use Illuminate\Database\Schema\Blueprint;

class Track
{
    /**
     * The name of default created by column.
     */
    const CREATED_BY = 'created_by';

    /**
     * The name of default updated by column.
     */
    const UPDATED_BY = 'updated_by';

    /**
     * TThe name of default deleted by column.
     */
    const DELETED_BY = 'deleted_by';

    /**
     * Add default tracking columns to the table. Also create an index.
     *
     * @param \Illuminate\Database\Schema\Blueprint $table
     * @param boolean $usingSoftDelete
     */
    public static function columns(Blueprint $table, $usingSoftDelete)
    {
        $table->unsignedInteger(self::CREATED_BY)->nullable();
        $table->unsignedInteger(self::UPDATED_BY)->nullable();

        $table->index(static::CREATED_BY);
        $table->index(static::UPDATED_BY);

        if($usingSoftDelete)
        {
            $table->unsignedInteger(self::DELETED_BY)->nullable();
            $table->index(static::DELETED_BY);
        }
    }

    /**
     * Drop NestedSet columns.
     *
     * @param \Illuminate\Database\Schema\Blueprint $table
     * @param boolean $usingSoftDelete
     */
    public static function dropColumns(Blueprint $table, $usingSoftDelete)
    {
        $table->dropIndex(static::CREATED_BY);
        $table->dropIndex(static::UPDATED_BY);

        $table->dropColumn(static::CREATED_BY);
        $table->dropColumn(static::UPDATED_BY);

        if($usingSoftDelete)
        {
            $table->dropIndex(static::DELETED_BY);
            $table->dropColumn(static::DELETED_BY);
        }
    }
}