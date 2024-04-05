<?php

use App\Enum\Product\ProductStatusEnum;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Currency;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Brand::class);
            $table->foreignIdFor(Currency::class);
            $table->foreignIdFor(Category::class)->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->text('description')->nullable();
            $table->integer('status')->default(ProductStatusEnum::ACTIVE->value);
            $table->integer('unit');
            $table->integer('quantity')->comment('stok adedi');
            $table->integer('critical_quantity')->comment('kritik stok adedi');
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('sale_price', 10, 2);
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
