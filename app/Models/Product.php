<?php

namespace App\Models;

use App\Enum\Product\ProductStatusEnum;
use App\Enum\Product\ProductUnitEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory, HasSlug, HasHashid, HashidRouting;

    protected $fillable = [
        'brand_id',
        'currency_id',
        'name',
        'slug',
        'code',
        'description',
        'status',
        'unit',
        'quantity',
        'critical_quantity',
        'purchase_price',
        'sale_price',
        'meta_keywords',
        'meta_description',
    ];

    protected $casts = [
        'status' => ProductStatusEnum::class,
        'unit' => ProductUnitEnum::class,
        'quantity' => 'integer',
        'critical_quantity' => 'integer',
        'purchase_price' => 'float',
        'sale_price' => 'float',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getStockAttribute(): string
    {
        return $this->quantity <= 0 ? 'Yok' : 'Var';
    }

    public function getUnitFormattedAttribute(): string
    {
        $values = [
            ProductUnitEnum::PIECE->value => 'ADET',
            ProductUnitEnum::SET->value => 'TAKIM',
        ];
        return $values[$this->unit->value];
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function productMedias(): HasMany
    {
        return $this->hasMany(ProductMedia::class);
    }
}
