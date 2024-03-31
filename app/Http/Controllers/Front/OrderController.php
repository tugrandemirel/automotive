<?php

namespace App\Http\Controllers\Front;

use App\Enum\Order\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Traits\ResponderTrait;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ResponderTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $orders = Order::query()
            ->whereRelation('user', 'user_id', '=', $user->id)
            ->with(['user', 'company'])
            ->orderByDesc('id')
            ->paginate(20);

        return view('app.order', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $user->load('company');

        /** @var Cart $carts */
        $carts = Cart::query()
            ->whereRelation('user', 'user_id', '=', $user->id)
            ->with(['product'])
            ->get();

        $code = $user?->company?->code.'-'.Carbon::now();

        /** @var Order $order */
        throw_unless( $order = Order::query()
            ->create([
                'user_id' => $user->id,
                'company_id' => $user->company->id,
                'code' => $code,
                'status' => OrderStatusEnum::PENDING
            ]), QueryException::class, 'Sipariş oluşturulurken bir hata ile karşılaşıldı.');

        foreach ($carts as $cart) {

            $attributes = collect([
                'order_id' => $order->id,
                'product_id' => $cart?->product_id,
                'currency_id' => $cart?->currency_id,
                'product_code' => $cart?->product?->code,
                'quantity' => (int)$cart?->quantity,
                'price' => (float)$cart?->price,
                'total_price' => (float)$cart?->total_price,
                'unit' => $cart?->unit,
                'status' => OrderStatusEnum::PENDING,
                'general_discount' => (float)$cart?->general_discount,
                'vat' => (float)$cart?->vat,
            ]);

            /** @var OrderDetail */
            throw_unless(OrderDetail::query()->create($attributes->toArray()), QueryException::class, 'Sipariş oluşturulurken bir hata ile karşılaşıldı.');

            throw_unless($cart->delete(), QueryException::class, 'Sepet boşaltma sırasında bir hata ile karşılaşıldı');
        }

        alert()->success('Siparişiniz alınmıştır. Bizi tercih ettiğiniz için teşekkürler.')->showConfirmButton('Tamam', '#3085d6');

        return to_route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /** @var Order $order */
        $order = Order::query()
            ->with('company')
            ->findByHashidOrFail($id);

        /** @var OrderDetail $orderDetails */
        $orderDetails = OrderDetail::query()
            ->whereRelation('order', 'order_id', '=', $order?->id)
            ->with( 'product', 'currency', 'product.brand')
            ->get();

        return view('app.order-detail', compact('order', 'orderDetails'));
    }

}
