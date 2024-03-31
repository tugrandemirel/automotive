<?php

namespace App\Http\Controllers\Front;

use App\Enum\Product\ProductStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Cart\CartStoreRequest;
use App\Http\Requests\Front\Cart\CartUpdateRequest;
use App\Http\Requests\Front\Cart\SingleDestroyRequest;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use App\Traits\ResponderTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    use ResponderTrait;

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var User $user */
        $user = auth()->user();

        /** @var Company $company */
        $company = $user->load('company')->company;

        /** @var Cart $carts */
        $carts = Cart::query()
            ->whereRelation('user', 'user_id', $user?->id)
            ->whereRelation('company', 'company_id', $company?->id)
            ->with(['product', 'currency', 'category', 'brand'])
            ->get();

        return view('app.cart', compact('company', 'carts'));
    }

    /**
     * @throws \Throwable
     */
    public function store(CartStoreRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());

        /** @var User $user */
        $user = auth()->user();
        $user->load('company');

        /** @var Product $product */
        $product = Product::query()
            ->where('id', $attributes->get('product_id'))
            ->where('status', ProductStatusEnum::ACTIVE)
            ->firstOrFail();

        $attributes->put('company_id', $user?->company_id);
        $attributes->put('category_id', $product?->category_id);
        $attributes->put('brand_id', $product?->brand_id);
        $attributes->put('currency_id', $product?->currency_id);
        $attributes->put('product_code', $product?->code);
        $attributes->put('price', $product?->sale_price + ($product?->sale_price * 20 /100));
        $attributes->put('total_price', $attributes->get('quantity') * ($product?->sale_price + ($product?->sale_price * 20 /100)));
        $attributes->put('unit', $product?->unit);
        $attributes->put('general_discount', $user?->company?->general_discount);
        $attributes->put('vat', 20);

        throw_unless($user->carts()->updateOrCreate([ 'product_id' => $product?->id],$attributes->toArray()), QueryException::class, 'Ürün sepete eklenirken bir hata ile karşılaşıldı.');

        return $this->success(['message', 'Ürün başarılı bir şekilde sepete eklendi.']);
    }

    /**
     * @throws \Throwable
     */
    public function update(CartUpdateRequest $request, string $id): JsonResponse
    {
        $attributes = collect($request->validated());

        /** @var Cart $cart */
        $cart = Cart::query()
            ->findByHashidOrFail($id);

        throw_unless($cart->update($attributes->toArray()), QueryException::class, 'Adet güncelleme işlemi sırasında bir hata ile karşılaşıldı');

        return $this->success(['message' => 'Adet güncelleme işlemi başarılı bir şekilde gerçekleştirildi.']);

    }

    /**
     * @throws \Throwable
     */
    public function destroy(string $id): JsonResponse
    {
        /** @var Cart $cart */
        $cart = Cart::query()
            ->findByHashidOrFail($id);

        throw_unless($cart->delete(), QueryException::class, 'Silme işlemi sırasında bir hata ile karşılaşıldı.');

        return $this->success(['message' => 'Silme işlemi başarılı bir şekilde gerçekleştirildi.']);
    }

    /**
     * @throws \Throwable
     */
    public function singleDestroy(SingleDestroyRequest $request, string $id): JsonResponse
    {
        $attributes = collect($request->validated());

        /** @var Cart $cart */
        $cart = Cart::query()
            ->findByHashidOrFail($id);

        throw_unless($cart->update($attributes->toArray()), QueryException::class, 'Silme işlemi sırasında bir hata ile karşılaşıldı.');

        return $this->success(['message' => 'Silme işlemi başarılı bir şekilde gerçekleştirildi.']);
    }
}
