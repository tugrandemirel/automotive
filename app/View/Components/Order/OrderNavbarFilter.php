<?php

namespace App\View\Components\Order;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderNavbarFilter extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $url)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.order.order-navbar-filter');
    }
}
