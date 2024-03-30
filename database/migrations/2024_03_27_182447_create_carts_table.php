<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Product;
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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Company::class)->nullable();
            $table->foreignIdFor(Product::class);
            $table->foreignIdFor(Category::class)->nullable();
            $table->foreignIdFor(Brand::class);
            $table->foreignIdFor(Currency::class)->nullable();
            $table->string('product_code');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->integer('unit');
            $table->decimal('general_discount')->comment('genel iskonto')->nullable();
            $table->decimal('vat')->comment('KDV')->default(20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
