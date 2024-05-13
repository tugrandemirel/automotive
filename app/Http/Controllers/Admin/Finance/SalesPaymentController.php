<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Enum\SalesPayment\SalesPaymentPaymentMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Finance\SalesPaymentStoreRequest;
use App\Models\Company;
use App\Models\Order;
use App\Models\SalesPayment;
use App\Traits\ResponderTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SalesPaymentController extends Controller
{
    use ResponderTrait;
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
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.finance.sales-payment.payment', compact('company', 'order', 'salesPayments'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(SalesPaymentStoreRequest $request, string $company): RedirectResponse
    {

        /** @var Company $company */
        $company = Company::query()
            ->findByHashidOrFail($company);

        $attributes = collect($request->validated());

        $attributes->put('payment_method', SalesPaymentPaymentMethodEnum::PAYMENT);

        throw_unless($company?->salesPayments()->create($attributes->toArray()), QueryException::class, 'Satış ödeme girişi sırasında bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.');

        return redirect()->back();

    }

    public function update(SalesPaymentStoreRequest $request, string $company, SalesPayment $salesPayment)
    {

        /** @var Company $company */
        $company = Company::query()
            ->findByHashidOrFail($company);

        $attributes = collect($request->validated());

        throw_unless($salesPayment->update($attributes->toArray()), QueryException::class, 'Satış ödeme güncellemesi sırasında bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.');

        return redirect()->back();
    }

    public function destroy(string $company, SalesPayment $salesPayment)
    {
        /** @var Company $company */
        $company = Company::query()
            ->findByHashidOrFail($company);


        throw_unless($salesPayment->delete(), QueryException::class, 'Ürün silme işlemi gerçekleştirilemedi.');

        return $this->success(['message', 'Silme işlemi başarılı bir şekilde gerçekleştirildi.']);
    }
}
