<?php

namespace App\Filters\Front\Product;

use EloquentFilter\ModelFilter;

class ProductFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function product($value)
    {
        if (is_null($value)) {
            return $this;
        }

        return $this->whereLike('name', $value)
            ->orWhereLike('code');
    }
}
