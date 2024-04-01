<?php

namespace App\Models;

use App\Enum\Company\CompanyCurrentEnum;
use App\Enum\Order\OrderStatusEnum;
use App\Enum\Product\ProductUnitEnum;
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
        'status' => OrderStatusEnum::class,
        'payment_method' => CompanyCurrentEnum::class
    ];

    public function getPaymentMethodFormattedAttribute(): string
    {
        $values = [
            CompanyCurrentEnum::CURRENT->value => 'Cari',
            CompanyCurrentEnum::NOT_CURRENT->value => 'Cari Değil',
        ];
        return $values[$this->payment_method->value];
    }

    public function getPaymentMethodColorFormattedAttribute(): string
    {
        $values = [
            CompanyCurrentEnum::CURRENT->value => 'success',
            CompanyCurrentEnum::NOT_CURRENT->value => 'danger',
        ];
        return $values[$this->payment_method->value];
    }

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
