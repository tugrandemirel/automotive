<?php

namespace App\Models;

use App\Enum\SystemSetting\Currency\CurrencyMainEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'main',
    ];

    protected $casts = [
        'main' => CurrencyMainEnum::class
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Currency::class);
    }
}
