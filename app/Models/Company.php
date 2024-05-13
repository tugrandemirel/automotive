<?php

namespace App\Models;

use App\Enum\Company\CompanyCreditCanPayEnum;
use App\Enum\Company\CompanyCurrentCanPayEnum;
use App\Enum\Company\CompanyCurrentEnum;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class Company extends Model
{
    use HasFactory;
    use HasHashid;
    use HashidRouting;
    use Filterable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'code',
        'bank_information',
        'description',
        'file',
        'current',
        'current_can_pay',
        'credit_can_pay',
        'general_discount',
        'advance_discount',
        'one_shot_discount',
        'city',
        'district',
        'address',
        'tax_administration',
        'identity_number',
    ];

    protected $casts = [
        'address' => 'array',
        'current' => CompanyCurrentEnum::class,
        'current_can_pay' => CompanyCurrentCanPayEnum::class,
        'credit_can_pay' => CompanyCreditCanPayEnum::class,
        'general_discount' => 'float',
        'advance_discount' => 'float',
        'one_shot_discount' => 'float',
    ];

    public static function booted(): void
    {
        static::deleting(function (Company $company){
            $company->authorizedPeople()->delete();
        });
    }

    public function authorizedPeople(): HasMany
    {
        return $this->hasMany(AuthorizedPerson::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value.'%');
    }

    public function scopeOrWhereLike($query, $column, $value)
    {
        return $query->orWhere($column, 'like', '%'.$value.'%');
    }

    public function salesPayments(): HasMany
    {
        return $this->hasMany(SalesPayment::class);
    }

    public function getTotalOrderAmount()
    {
        // Şirkete ait tüm siparişlerin ID'lerini alın
        $orderIds = $this->orders()->pluck('id');

        // Bu siparişlere ait orderDetails tablosundaki total_price değerlerinin toplamını alın
        $totalAmount = OrderDetail::query()
            ->whereIn('order_id', $orderIds)
            ->sum('total_price');

        return $totalAmount;
    }
}
