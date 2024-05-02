<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Order;
use App\Models\SalesPayment;
use Illuminate\Http\Request;

class SalesPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $company, string $order)
    {
        /** @var Company $company */
        $company = Company::query()
            ->findByHashidOrFail($company);

        /** @var Order $order */
        $order = Order::query()
            ->whereRelation('company', 'id',  '=', $company?->id)
            ->findByHashidOrFail($order);

        /** @var SalesPayment $salesPayments */
        $salesPayments = SalesPayment::query()
            ->where('order_id', $order?->id)
            ->paginate(20);

        return view('admin.finance.sales-payment.index', compact('company', 'order', 'salesPayments'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $company, string $order)
    {

        /** @var Company $company */
        $company = Company::query()
            ->findByHashidOrFail($company);

        /** @var Order $order */
        $order = Order::query()
            ->whereRelation('company', 'id',  '=', $company?->id)
            ->findByHashidOrFail($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
