<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->enum('status', [
                'order_received',
                'processing',
                'ready',
                'out_for_delivery',
                'delivered',
                'cancelled',
            ])->default('order_received');
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
