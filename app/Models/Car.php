<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    protected $fillable = [
        'car_name',
        'day_rate',
        'month_rate',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'day_rate' => 'double',
            'month_rate' => 'double',
        ];
    }

    public function orders(): hasMany
    {
        return $this->hasMany(Order::class);
    }
}
