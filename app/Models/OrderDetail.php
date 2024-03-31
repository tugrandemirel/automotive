<?php

namespace App\Models;

use App\Enum\Order\OrderDetailStatusEnum;
use App\Enum\Order\OrderStatusEnum;
use App\Enum\Product\ProductUnitEnum;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class OrderDetail extends Model
{
    use HasFactory, Filterable, HasHashid, HashidRouting;

    protected $fillable = [
        'order_id',
        'product_id',
        'currency_id',
        'product_code',
        'quantity',
        'price',
        'total_price',
        'unit',
        'general_discount',
        'vat',
        'status'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'float',
        'unit' => ProductUnitEnum::class,
        'status' => OrderDetailStatusEnum::class
    ];

    public function getStatusFormattedAttribute(): string
    {
        $values = [
            OrderStatusEnum::PENDING->value => 'Sipariş Alındı',
            OrderStatusEnum::PROCESSING->value => 'Sipariş Hazırlanıyor',
            OrderStatusEnum::SHIPPED->value => 'Sipariş Hazırlandı. Yola Çıktı',
            OrderStatusEnum::COMPLETED->value => 'Sipariş Tamamlandı',
            OrderStatusEnum::CANCELLED->value => 'Sipariş İptal Edildi',
        ];
        return $values[$this->status->value];
    }

    public function getUnitFormattedAttribute(): string
    {
        $values = [
            ProductUnitEnum::PIECE->value => 'ADET',
            ProductUnitEnum::SET->value => 'TAKIM',
        ];
        return $values[$this->unit->value];
    }

    public function getNetPriceVatAttribute()
    {
        if (is_null($this->general_discount) || $this->general_discount == 0) {
            return $this->price;
        }

        return $this->price - ($this->price * $this->general_discount/100);
    }

    public function getTotalPriceAttribute()
    {
        return $this->getNetPriceVatAttribute() * $this->quantity;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
