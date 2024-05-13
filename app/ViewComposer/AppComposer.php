<?php

namespace App\ViewComposer;

use App\Models\Company;
use Illuminate\View\View;

class AppComposer
{
    public function compose(View $view): void
    {
        $user = auth()->user();

        /** @var Company $company */
        $company = $user->load('company')->company;

        $cardCount =  $company->carts()->count() ?? 0;

        $view->with('cardCount', $cardCount);
    }
}
