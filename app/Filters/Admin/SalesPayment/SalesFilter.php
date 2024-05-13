<?php

namespace App\Filters\Admin\SalesPayment;

use EloquentFilter\ModelFilter;

class SalesFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function code($value)
    {
        if (is_null(trim($value))) {
            return $this;
        }

        return $this->whereLike('code', trim($value));
    }

    public function date($value)
    {
        if (is_null(trim($value))) {
            return $this;
        }

        return $this->whereDate('created_at', '>=', $value);
    }

    public function user($value)
    {
        if (is_null(trim($value))) {
            return $this;
        }

        return $this->whereHas('user', function ($query) use ($value) {
            $query->where('username', $value);
        });
    }
}
