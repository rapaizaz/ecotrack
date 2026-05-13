<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcoScore extends Model
{
    protected $fillable = [
        'user_id',
        'month',
        'year',
        'electricity_score',
        'water_score',
        'waste_score',
        'total_score',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
