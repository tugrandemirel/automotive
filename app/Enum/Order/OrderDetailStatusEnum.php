<?php

namespace App\Enum\Order;

enum OrderDetailStatusEnum: int
{
    /**
     * pending: Beklemede - Sipariş alındı.
     * processing: İşleniyor - Sipariş hazırlanıyor.
     * shipped: Kargoya verildi - Sipariş kargoya teslim edildi. - siparişi hazırlandı yola çıktı
     * completed: Tamamlandı - Sipariş tamamlandı ve müşteriye teslim edildi.
     * cancelled: İptal edildi - Sipariş iptal edildi.
     */
    case PENDING = 0;

    case PROCESSING = 1;

    case SHIPPED = 2;

    case COMPLETED = 3;

    case CANCELLED = 4;
}
