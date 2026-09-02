<?php

namespace Tests\Unit;

use App\Enums\OrderStatus;
use Tests\TestCase;

class OrderStatusTest extends TestCase
{
    public function test_tracking_flow_and_progress_percentages_are_defined(): void
    {
        $this->assertSame([
            OrderStatus::ORDER_RECEIVED,
            OrderStatus::PROCESSING,
            OrderStatus::READY,
            OrderStatus::OUT_FOR_DELIVERY,
            OrderStatus::DELIVERED,
        ], OrderStatus::trackingSteps());

        $this->assertSame(20, OrderStatus::ORDER_RECEIVED->progressPercentage());
        $this->assertSame(40, OrderStatus::PROCESSING->progressPercentage());
        $this->assertSame(60, OrderStatus::READY->progressPercentage());
        $this->assertSame(80, OrderStatus::OUT_FOR_DELIVERY->progressPercentage());
        $this->assertSame(100, OrderStatus::DELIVERED->progressPercentage());
        $this->assertSame(100, OrderStatus::CANCELLED->progressPercentage());
    }
}
