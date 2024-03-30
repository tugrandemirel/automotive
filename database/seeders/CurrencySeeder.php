<?php

namespace Database\Seeders;

use App\Enum\SystemSetting\Currency\CurrencyMainEnum;
use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::query()
            ->create([
                'name' => 'Türk Lirası',
                'code' => 'TRY',
                'symbol' => '₺',
                'main' => CurrencyMainEnum::ACTIVE
            ]);
    }
}
