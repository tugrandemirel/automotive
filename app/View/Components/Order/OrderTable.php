<?php

namespace App\View\Components\Order;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderTable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $orders = null)
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.order.order-table');
    }
}
