<?php

namespace App\Models;

use App\Enum\Product\ProductStatusEnum;
use App\Enum\Product\ProductUnitEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class Cart extends Model
{
    use HasFactory, HasHashid, HashidRouting;

    protected $fillable = [
        'user_id',
        'company_id',
        'product_id',
        'category_id',
        'brand_id',
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
        'unit' => ProductUnitEnum::class,
        'quantity' => 'integer',
        'price' => 'float',
    ];

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
