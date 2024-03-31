<?php

use App\Enum\Company\CompanyCurrentEnum;
use App\Enum\Order\OrderStatusEnum;
use App\Models\Company;
use App\Models\Currency;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Company::class);
            $table->string('code');
            $table->tinyInteger('payment_method')->default(CompanyCurrentEnum::CURRENT->value);
            $table->tinyInteger('status')->default(OrderStatusEnum::PENDING->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
