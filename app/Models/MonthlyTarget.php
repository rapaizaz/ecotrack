<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyTarget extends Model
{
    protected $fillable = [
        'user_id',
        'month',
        'year',
        'target_electricity_kwh',
        'target_water_m3',
        'target_waste_kg',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
