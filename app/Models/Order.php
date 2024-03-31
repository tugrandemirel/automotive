<?php

namespace App\Models;

use App\Enum\Order\OrderStatusEnum;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class Order extends Model
{
    use HasFactory, Filterable, HasHashid, HashidRouting;

    protected $fillable = [
        'user_id',
        'company_id',
        'code',
        'payment_method',
        'status',
    ];

    protected $casts = [
        'status' => OrderStatusEnum::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
