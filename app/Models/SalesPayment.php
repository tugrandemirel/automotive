<?php

namespace App\Models;

use App\Enum\SalesPayment\SalesPaymentPaymentMethodEnum;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class SalesPayment extends Model
{
    use HasFactory, HasHashid, HashidRouting, Filterable;

    protected $fillable = [
        'company_id',
        'currency_id',
        'description',
        'type',
        'payment_method',
        'amount',
        'payment_date'
    ];

    protected $casts = [
        'payment_method' => SalesPaymentPaymentMethodEnum::class,
        'amount' => 'float',
        'payment_date' => 'datetime'
    ];


    public function getPaymentMethodFormattedAttribute(): string
    {
        $values = [
            SalesPaymentPaymentMethodEnum::SALES->value => 'Satış',
            SalesPaymentPaymentMethodEnum::PAYMENT->value => 'Ödeme',
        ];
        return $values[$this->payment_method->value];
    }

    public function getPaymentMethodColorFormattedAttribute(): string
    {
        $values = [
            SalesPaymentPaymentMethodEnum::SALES->value => 'success',
            SalesPaymentPaymentMethodEnum::PAYMENT->value => 'danger',
        ];
        return $values[$this->payment_method->value];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
