<?php
/** @copyright Tuğran Demirel */
namespace App\Enum\Company;

/** Kullanıcı cari ödeme yapabilmesi için ilgili enum */
enum CompanyCurrentEnum: int
{
    // Cari
    case CURRENT = 1;
    // Cari Değil
    case NOT_CURRENT = 0;
}
