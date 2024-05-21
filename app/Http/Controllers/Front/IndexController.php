<?php

namespace App\Http\Controllers\Front;

use App\Enum\Product\ProductStatusEnum;
use App\Enum\User\UserRoleEnum;
use App\Filters\Front\Product\ProductFilter;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Product $products */
        $products = Product::query()
            ->where('status', ProductStatusEnum::ACTIVE)
            ->with('brand')
            ->filter($request->all(), ProductFilter::class)
            ->with('currency')
            ->paginate(20);

        /** @var Company $company */
        $company = Company::query()
            ->whereRelation('user', 'id', auth()->id())
            ->firstOrFail();

        return view('app.index', compact('products', 'company'));
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function getMeCompany(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();

        /** @var Company $company */
        $company = Company::query()
            ->whereRelation('user', 'id', '=', $user?->id)
            ->firstOrFail();

        return view('app.about', compact('user', 'company'));
    }
}
