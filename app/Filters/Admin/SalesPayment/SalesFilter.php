<?php

namespace App\Filters\Admin\SalesPayment;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;
use Illuminate\Support\Str;

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

    public function dates($value)
    {
        if (is_null($value)) {
            return $this;
        }
        if (Str::contains($value,  '-')) {
            $dates = explode(' - ', $value);
            if (count($dates) === 2) {
                return $this->whereBetween('created_at', [
                    Carbon::parse($dates[0])->startOfDay(),
                    Carbon::parse($dates[1])->endOfDay(),
                ]);
            }
        }
        return $this;
    }
}
