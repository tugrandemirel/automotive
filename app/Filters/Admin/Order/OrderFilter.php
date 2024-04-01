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

    public function name($value)
    {
        if (is_null(trim($value))) {
            return $this;
        }

        return $this->with('user')->whereLike('name', trim($value));
    }

}
