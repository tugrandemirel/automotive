<?php

namespace App\Http\Controllers\Admin\Product;

use App\Enum\Brand\BrandIsActiveEnum;
use App\Helpers\ImageHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Traits\ResponderTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ResponderTrait;
    private string $_path = 'product/';
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::query()
            ->with(['brand'])
            ->paginate(20);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var Brand $brands */
        $brands = Brand::query()
            ->where('is_active', BrandIsActiveEnum::ACTIVE)
            ->get();

        /** @var Currency $currencies */
        $currencies = Currency::query()
            ->get();

        return view('admin.product.create', compact('brands', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $attributes = collect($request->validated());

        if ($attributes->get('images'))
        {
            $imageArr = $attributes->get('images');
            $images = [];
            foreach ($imageArr as $key => $value)
            {
                $images[$key]['path'] = ImageHelpers::upload($value, $this->_path);
            }
            $attributes->forget('images');
        } else {
            $attributes->forget('images');
        }

        throw_unless($product = Product::query()->create($attributes->toArray()), QueryException::class, 'Ürün eklenirken bir hata ile karşılaşıldı.');
        if (!empty($images)) {
            throw_unless($product->productMedias()->createMany($images), QueryException::class, 'Ürün resmi eklenirken bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.');
        }

        alert()->success('Başarılı', 'Ürün başarılı bir şekilde eklendi.');

        return to_route('admin.product.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product = Product::query()
            ->where('slug', $slug)
            ->with(['category', 'currency', 'brand', 'productMedias'])
            ->firstOrFail();

        /** @var Brand $brands */
        $brands = Brand::query()
            ->where('is_active', BrandIsActiveEnum::ACTIVE)
            ->get();

        /** @var Currency $currencies */
        $currencies = Currency::query()
            ->get();

        return view('admin.product.edit', compact('brands', 'product', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Throwable
     */
    public function update(ProductUpdateRequest $request, string $slug): RedirectResponse
    {
        $attributes = collect($request->validated());

        /** @var Product $product */
        $product = Product::query()
            ->where('slug', $slug)
            ->firstOrFail();

        if ($attributes->get('images'))
        {
            $imageArr = $attributes->get('images');
            $images = [];
            foreach ($imageArr as $key => $value)
            {
                $images[$key]['path'] = ImageHelpers::upload($value, $this->_path);
            }
            $attributes->forget('images');
        } else {
            $attributes->forget('images');
        }

        throw_unless($product?->update($attributes->toArray()), QueryException::class, 'Ürün güncellenirken bir hata ile karşılaşıldı.');
        if (!empty($images)) {
            throw_unless($product->productMedias()->createMany($images), QueryException::class, 'Ürün resmi güncellenirken bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.');
        }

        alert()->success('Başarılı', 'Ürün başarılı bir şekilde eklendi.');

        return to_route('admin.product.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws \Throwable
     */
    public function destroy(string $slug): JsonResponse
    {
        $product = Product::query()
            ->with('productMedias')
            ->findByHashid($slug);

        if ($product?->productMedias()->count() > 0) {
            throw_unless(ImageHelpers::multipleDelete($product?->productMedias), QueryException::class, 'Ürün resim silme işlemi gerçekleştirilemedi.');

            foreach ($product?->productMedias as $media) {
                dd($media);
            }
            throw_unless($product->productMedias()->delete(), QueryException::class, 'Ürün resim silme işlemi gerçekleştirilemedi.');
        }

        throw_unless($product->delete(), QueryException::class, 'Ürün silme işlemi gerçekleştirilemedi.');

        return $this->success(['message', 'Silme işlemi başarılı bir şekilde gerçekleştirildi.']);
    }

    /**
     *
     * @throws \Throwable
     */
    public function singleImageDelete(Request $request, $mediaHashId): JsonResponse
    {
        $productMedia = ProductMedia::query()
            ->findByHashid($mediaHashId);

        throw_unless(ImageHelpers::delete($productMedia?->path), QueryException::class, 'Ürün resim silme işlemi gerçekleştirilemedi.');
        throw_unless($productMedia?->delete(), QueryException::class, 'Ürün resim silme işlemi gerçekleştirilemedi.');

        return $this->success(['message', 'Silme işlemi başarılı bir şekilde gerçekleştirildi.']);
    }
}
