<?php

namespace App\ViewComposer;

use Illuminate\View\View;

class AppComposer
{
    public function compose(View $view): void
    {
        $user = auth()->user();

        $cardCount =  $user->carts()->count() ?? 0;

        $view->with('cardCount', $cardCount);
    }
}
