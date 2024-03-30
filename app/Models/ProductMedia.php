<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class ProductMedia extends Model
{
    use HasFactory, HashidRouting, HasHashid;

    protected $fillable = [
        'product_id',
        'path',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
