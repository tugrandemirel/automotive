<?php

namespace Database\Seeders;

use App\Enum\Product\ProductStatusEnum;
use App\Enum\Product\ProductUnitEnum;
use App\Models\Brand;
use App\Models\Currency;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Triger Seti',
            'Fren Balatası',
            'Sağ Ön Salıncak',
        ];

        $brandId = Brand::query()->first()->id;
        $currencyId = Currency::query()->first()->id;

        foreach ($names as $name) {

            $quantity = rand(0,100);
            $criticalQuantity = 15;
            $purchasePrice = rand(1000,5000);
            $salePrice = rand(1000,5000);

            Product::query()
                ->create([
                    'name' => $name,
                    'brand_id' => $brandId,
                    'currency_id' => $currencyId,
                    'code' => $this->code($name),
                    'status' => ProductStatusEnum::ACTIVE,
                    'unit' => ProductUnitEnum::PIECE,
                    'quantity' => $quantity,
                    'critical_quantity' => $criticalQuantity >= $quantity ? $criticalQuantity - 10 : $criticalQuantity,
                    'purchase_price' => $purchasePrice >= $salePrice ? $purchasePrice - 100 : $purchasePrice,
                    'sale_price' => max($salePrice, $purchasePrice)
                ]);
        }
    }

    public function code($value): string
    {

        $value = turkishToEnglishChars(Str::replace(' ', '', $value));

        return 'PR-'.$value.Carbon::now()->format('Y');
    }
}
