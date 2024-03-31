<?php

use App\Models\Currency;
use App\Models\Order;
use App\Models\Product;
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
        /**
         *id: Benzersiz sipariş detayı kimliği.
         * order_id: Hangi siparişe ait olduğunu belirten referans.
         * product_id: Sipariş detayındaki ürünün kimliği.
         * product_code: Ürün kodu.
         * quantity: Sipariş edilen ürün miktarı.
         * price: Sipariş edilen ürünün birim fiyatı.
         * total_price: Sipariş detayı için toplam fiyat (miktar * birim fiyat).
         * unit: Ürünün birimi (adet, kilogram, vb.).
         * general_discount: Genel indirim (isteğe bağlı).
         * vat: KDV oranı.
         * created_at ve updated_at: Oluşturulma ve güncelleme tarihleri.
         */
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class);
            $table->foreignIdFor(Product::class);
            $table->foreignIdFor(Currency::class);
            $table->string('product_code');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->integer('unit');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('order_details');
    }
};
