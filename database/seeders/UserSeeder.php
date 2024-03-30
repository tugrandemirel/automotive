<?php

namespace Database\Seeders;

use App\Enum\User\UserRoleEnum;
use App\Enum\User\UserStatusEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()
            ->create([
                'name' => 'Admin',
                'surname' => 'Admin',
                'username' => 'admin',
                'phone' => '05443380633',
                'role' => UserRoleEnum::ADMIN,
                'status' => UserStatusEnum::ACTIVE,
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456789'),
            ]);

        $companyId = Company::query()
            ->where('email', 'info@demirel.com')
            ->firstOrFail()
            ->id;

        User::query()
            ->create([
                'company_id' => $companyId,
                'name' => 'User',
                'surname' => 'user',
                'username' => 'user',
                'phone' => '05443380633',
                'role' => UserRoleEnum::USER,
                'status' => UserStatusEnum::ACTIVE,
                'email' => 'user@user.com',
                'password' => bcrypt('123456789'),
            ]);
    }
}
