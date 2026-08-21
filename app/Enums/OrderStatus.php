<?php

namespace App\Enums;

enum OrderStatus: string
{
    case ORDER_RECEIVED = 'order_received';
    case PROCESSING = 'processing';
    case READY = 'ready';
    case OUT_FOR_DELIVERY = 'out_for_delivery';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
}