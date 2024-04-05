<?php

use App\Enum\Company\CompanyCreditCanPayEnum;
use App\Enum\Company\CompanyCurrentCanPayEnum;
use App\Enum\Company\CompanyCurrentEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('code')->nullable();
            $table->string('tax_administration')->nullable();
            $table->string('identity_number')->nullable();
            $table->text('bank_information')->nullable();
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->boolean('current')->default(CompanyCurrentEnum::CURRENT->value);
            $table->boolean('current_can_pay')->comment('cari ödeyebilir')->default(CompanyCurrentCanPayEnum::FALSE);
            $table->boolean('credit_can_pay')->comment('kredi karti ile ödeyebilir')->default(CompanyCreditCanPayEnum::FALSE);
            $table->decimal('general_discount')->comment('genel iskonto')->default(0);
            $table->decimal('advance_discount')->comment('peşin iskonto')->default(0);
            $table->decimal('one_shot_discount')->comment('tek çekim iskonto')->default(0);
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->json('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
