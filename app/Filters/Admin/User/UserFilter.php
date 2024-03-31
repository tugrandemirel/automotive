<?php

namespace App\Filters\Admin\User;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    /**
     * @param $value
     * @return $this|UserFilter
     */
    public function fullName($value): UserFilter
    {
        if (is_null($value)) {
            return $this;
        }

        return $this->where(function($query) use ($value) {
            $query->whereLike('name', $value)
                ->orWhereLike('name', $value);
        });
    }

    public function company($value)
    {
        if (is_null($value)) {
            return $this;
        }

        return $this->whereHas('company', function ($query) use ($value) {
            $query->whereLike('name', $value);
        });
    }
}
