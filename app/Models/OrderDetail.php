<?php

namespace App\Models;

use App\Enum\Order\OrderDetailStatusEnum;
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
