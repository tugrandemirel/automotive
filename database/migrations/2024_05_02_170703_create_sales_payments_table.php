<?php

use App\Enum\SalesPayment\SalesPaymentPaymentMethodEnum;
use App\Models\Currency;
use App\Models\Order;
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
        Schema::create('sales_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class);
            $table->foreignIdFor(Currency::class)->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->boolean('payment_method')->default(SalesPaymentPaymentMethodEnum::SALES->value);
            $table->decimal('amount', 10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_payments');
    }
};
