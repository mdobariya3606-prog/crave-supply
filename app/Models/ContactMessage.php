<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'business_name',
        'email',
        'phone',
        'message',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }
}
