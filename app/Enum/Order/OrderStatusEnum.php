<?php

namespace App\Enum\Order;

enum OrderStatusEnum: int
{
    /**
     * pending: Beklemede - Sipariş alındı ancak işleme alınmadı.
     * processing: İşleniyor - Sipariş hazırlanıyor.
     * shipped: Kargoya verildi - Sipariş kargoya teslim edildi.
     * completed: Tamamlandı - Sipariş tamamlandı ve müşteriye teslim edildi.
     * cancelled: İptal edildi - Sipariş iptal edildi.
     */
    case PENDING = 0;

    case PROCESSING = 1;

    case SHIPPED = 2;

    case COMPLETED = 3;

    case CANCELLED = 4;
}
