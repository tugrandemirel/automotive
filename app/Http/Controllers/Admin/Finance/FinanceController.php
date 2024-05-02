<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Filters\Admin\Finance\FinanceFilter;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * @param Request $request
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Company $companies */
        $companies = Company::query()
            ->withCount('orders')
            ->with('user')
            ->filter($request->all(), FinanceFilter::class)
            ->paginate(20);

        return view('admin.finance.index', compact('companies'));
    }

    public function show(string $id)
    {
        $company = Company::query()
            ->findByHashidOrFail($id);

        /** @var Order $orders */
        $orders = Order::query()
            ->whereRelation('company', 'id', '=', $company?->id)
            ->with('user')
            ->paginate(20);

        return view('admin.finance.show', compact('orders', 'company'));
    }

}
