<?php
/** @copyright Tuğran Demirel */
namespace App\Enum\Company;

/** Kullanıcı kredi karti ile ödeyebilir ödeyemez */
enum CompanyCreditCanPayEnum: int
{
    case TRUE = 1 ;
    case FALSE = 0;
}
