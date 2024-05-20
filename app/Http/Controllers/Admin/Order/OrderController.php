<?php

namespace App\Http\Controllers\Admin\Order;

use App\Enum\Order\OrderStatusEnum;
use App\Filters\Admin\Order\OrderFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\OrderChangeStatusRequest;
use App\Models\Order;
use App\Traits\ResponderTrait;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{
    use ResponderTrait;

    /**
     * @param Request $request
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Order $orders */
        $orders = Order::query()
            ->with('company', 'user')
            ->withCount('orderDetails')
            ->filter($request->all(), OrderFilter::class)
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.order.index', compact('orders'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function getPending(Request $request): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Order $orders */
        $orders = Order::query()
            ->with('company', 'user')
            ->withCount('orderDetails')
            ->where('status', OrderStatusEnum::PENDING)
            ->filter($request->all(), OrderFilter::class)
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.order.pending', compact('orders'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function getProcessing(Request $request): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {

        $orders = Order::query()
            ->with('company', 'user')
            ->withCount('orderDetails')
            ->where('status', OrderStatusEnum::PROCESSING)
            ->filter($request->all(), OrderFilter::class)
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.order.processing', compact('orders'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function getShipped(Request $request): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {

        $orders = Order::query()
            ->with('company', 'user')
            ->withCount('orderDetails')
            ->where('status', OrderStatusEnum::SHIPPED)
            ->filter($request->all(), OrderFilter::class)
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.order.shipped', compact('orders'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function getCompleted(Request $request): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {

        $orders = Order::query()
            ->with('company', 'user')
            ->withCount('orderDetails')
            ->where('status', OrderStatusEnum::COMPLETED)
            ->filter($request->all(), OrderFilter::class)
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.order.completed', compact('orders'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function getCancelled(Request $request): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Order $orders */
        $orders = Order::query()
            ->with('company', 'user')
            ->withCount('orderDetails')
            ->where('status', OrderStatusEnum::CANCELLED)
            ->filter($request->all(), OrderFilter::class)
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.order.cancelled', compact('orders'));
    }

    /**
     * @param string $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Order $order */
        $order = Order::query()
            ->with('orderDetails', 'user', 'company')
            ->findByHashidOrFail($id);

        $user = $order->user;
        $company = $order->company;
        $orderDetails = $order->orderDetails;

        return view('admin.order.show', compact('user', 'company','orderDetails', 'order'));
    }

    /**
     * @throws \Throwable
     */
    public function setStatus(OrderChangeStatusRequest $request, string $id): JsonResponse
    {

        $attributes = collect($request->validated());

        /** @var Order $order */
        $order = Order::query()
            ->with('orderDetails', 'company')
            ->findByHashidOrFail($id);

        $company = $order->company;

        throw_unless($order->update($attributes->toArray()), QueryException::class, 'Sipariş durumu değiştirme işlemi sırasında bir hata ile karılaşıldı.');
        throw_unless($order->orderDetails()->update($attributes->toArray()), QueryException::class, 'Sipariş durumu değiştirme işlemi sırasında bir hata ile karılaşıldı.');

        /*f($attributes->get('status') == OrderStatusEnum::COMPLETED->value) {
            $orderAmount = $order->orderDetails()->sum('total_price');
            $currencyId = $order->orderDetails()->select('currency_id')->latest()->first()->currency_id;

            $salesPaymentCreate =  $company->salesPayments()->create([
                'currency_id' => $currencyId,
                'description' => 'Sistem üzerinden satın alma işlemi',
                'payment_method' => $order?->payment_method,
                'amount' => $orderAmount,
                'payment_date' => Carbon::now()
            ]);

            throw_unless($salesPaymentCreate, QueryException::class, 'Satış işlemi finans modülüne düşmedi.');
        }*/

        return $this->success(['message' => 'Başarılı bir şekilde durum güncellemesi gerçekleştirildi.']);
    }
}
