<?php

namespace App\Imports\Product;

use App\Enum\Product\ProductStatusEnum;
use App\Enum\Product\ProductUnitEnum;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductExcel implements ToCollection, WithStartRow
{
    private bool $checkHeader = false;
    private bool $checkFormat = false;


    /**
     * @param Collection $collection
     * @throws \Throwable
     */
    public function collection(Collection $collection)
    {
        /** @var Brand $brandId */
        $brandId = Brand::query()
            ->first()
            ->id;

        /** @var Currency $currencyId */
        $currencyId = Currency::query()
            ->first()
            ->id;

        foreach ($collection as $row) {
            $unit = $row[2] == 'Adet' ? ProductUnitEnum::PIECE : ProductUnitEnum::SET;

            $product = Product::query()
                ->where('code', 'like', '%' . (string)$row[1] . '%')
                ->first();

            if ($product) {
                $product->update([
                    'name' => (string)$row[0],
                    'unit' => $unit,
                    'quantity' => $row[3],
                    'critical_quantity' => $row[4],
                    'purchase_price' => $row[5],
                    'sale_price' => $row[6],
                    'brand_id' => $brandId,
                    'currency_id' => $currencyId,
                    'status' => ProductStatusEnum::ACTIVE
                ]);
            } else {
                $productCreate = Product::query()
                    ->create([
                        'name' => $row[0],
                        'code' => $row[1],
                        'unit' => $unit,
                        'quantity' => $row[3],
                        'critical_quantity' => $row[4],
                        'purchase_price' => $row[5],
                        'sale_price' => $row[6],
                        'brand_id' => $brandId,
                        'currency_id' => $currencyId,
                        'status' => ProductStatusEnum::ACTIVE
                    ]);
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
