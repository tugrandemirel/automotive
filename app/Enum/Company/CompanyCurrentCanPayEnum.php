<?php
/** @copyright Tuğran Demirel */
namespace App\Enum\Company;

/** Kullanıcı cari ödeyebilir ödeyemez */
enum CompanyCurrentCanPayEnum: int
{
    case TRUE = 1 ;
    case FALSE = 0;
}
