<?php

namespace Database\Seeders;

use App\Enum\Company\CompanyCreditCanPayEnum;
use App\Enum\Company\CompanyCurrentCanPayEnum;
use App\Enum\Company\CompanyCurrentEnum;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::query()
            ->create([
                'name' => 'Demirel A.Ş',
                'email' => 'info@demirel.com',
                'phone' => '0544 338 0633',
                'bank_information' => 'Ziraat Bankası. İban: TR11111111111',
                'description' => 'Demirel A.Ş bir Tuğran Demirel Kuruluşudur.',
                'current' => CompanyCurrentEnum::CURRENT,
                'current_can_pay' => CompanyCurrentCanPayEnum::TRUE,
                'credit_can_pay' => CompanyCreditCanPayEnum::TRUE,
                'general_discount' => 10,
                'advance_discount' => 10,
                'one_shot_discount' => 10,
                'city' => 'Yozgat',
                'address' => ['Yozgat', 'Sorgun'],
                'tax_administration' => 'Yozgat Veri Dairesi',
                'identity_number' => '1111111111'
            ]);
    }
}
