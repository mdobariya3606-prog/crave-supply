<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_id',
        'status',
        'changed_by'
    ];

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
        ];
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'changed_by');
    }

}
