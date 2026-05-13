<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaterUsage extends Model
{
    protected $fillable = [
        'user_id',
        'month',
        'year',
        'cubic_meter',
        'cost',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
