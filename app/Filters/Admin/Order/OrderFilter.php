<?php

namespace App\Filters\Admin\Order;

use EloquentFilter\ModelFilter;

class OrderFilter extends ModelFilter
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

    public function status($value)
    {
        if (is_null(trim($value))) {
            return $this;
        }

        return $this->where('status', $value);
    }

}
