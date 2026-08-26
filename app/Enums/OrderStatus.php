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

    public function nextStatuses(): array
    {
        return match ($this) {
            self::ORDER_RECEIVED => [self::PROCESSING, self::CANCELLED],
            self::PROCESSING => [self::READY, self::CANCELLED],
            self::READY => [self::OUT_FOR_DELIVERY],
            self::OUT_FOR_DELIVERY => [self::DELIVERED],
            self::DELIVERED, self::CANCELLED => [],
        };
    }

    public function canTransitionTo(self $status): bool
    {
        return $this === $status || in_array($status, $this->nextStatuses(), true);
    }
}
