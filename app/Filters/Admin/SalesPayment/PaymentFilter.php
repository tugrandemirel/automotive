<?php

namespace App\Filters\Admin\SalesPayment;

use EloquentFilter\ModelFilter;

class PaymentFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function date($value)
    {
        if (is_null(trim($value))) {
            return $this;
        }

        return $this->whereDate('payment_date', '>=', $value);
    }
}
