<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Filters\Admin\Finance\FinanceFilter;
use App\Filters\Admin\SalesPayment\PaymentFilter;
use App\Filters\Admin\SalesPayment\SalesFilter;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Order;
use App\Models\SalesPayment;
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
            ->withSum('salesPayments', 'amount')
            ->with([
                'orders' => function ($query) {
                    $query->withSum('orderDetails', 'total_price');
                },
                'user',
            ])
            ->filter($request->all(), FinanceFilter::class)
            ->paginate(20);

        return view('admin.finance.index', compact('companies'));
    }

    public function show(Request $request, string $id)
    {
        $company = Company::query()
            ->with('salesPayments')
            ->findByHashidOrFail($id);

        /** @var Order $orders */
        $orders = Order::query()
            ->whereRelation('company', 'id', '=', $company?->id)
            ->withSum('orderDetails', 'total_price')
            ->filter($request->all(), SalesFilter::class)
            ->with('user')
            ->paginate(20);

        return view('admin.finance.sales-payment.sales', compact('orders', 'company'));
    }

    public function payment(Request $request, string $company)
    {
        /** @var Company $company */
        $company = Company::query()
            ->findByHashidOrFail($company);

        /** @var SalesPayment $salesPayments */
        $salesPayments = SalesPayment::query()
            ->filter($request->all(), PaymentFilter::class)
            ->where('company_id', $company?->id)
            ->orderByDesc('payment_date')
            ->paginate(20);

        return view('admin.finance.sales-payment.payment', compact('company', 'salesPayments'));
    }
}
