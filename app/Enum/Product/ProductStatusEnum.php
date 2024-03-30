<?php

namespace App\Enum\Product;

enum ProductStatusEnum: int
{
    // Pasif
    case PASSIVE = 0;
    // Aktig
    case ACTIVE = 1;
    // Tedarik tes
    case SUPPLY = 3;

}
