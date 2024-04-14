<?php

namespace App\Filters\Admin\Company;

use EloquentFilter\ModelFilter;

class CompanyFilter extends ModelFilter
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

        return $this->whereLike('name', $value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function city($value): static
    {
        if (is_null($value)) {
            return $this;
        }

        return $this->whereLike('city', $value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function district($value): static
    {
        if (is_null($value)) {
            return $this;
        }

        return $this->whereLike('district', $value);
    }
}
