<?php

namespace App\Filters\Admin\Product;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;
use Illuminate\Support\Str;

class ProductFilter extends ModelFilter
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
     * @return $this
     */
    public function name($value)
    {
        if (is_null($value)) {
            return $this;
        }

        return $this->whereLike('name', $value)
            ->orWhereLike('code', trim($value));
    }

    public function ref($value)
    {
        if (is_null($value)) {
            return $this;
        }

        return $this->whereLike('code', trim($value));
    }
}
