<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address',
        'phone',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function electricityUsages()
    {
        return $this->hasMany(ElectricityUsage::class);
    }

    public function waterUsages()
    {
        return $this->hasMany(WaterUsage::class);
    }

    public function wasteRecords()
    {
        return $this->hasMany(WasteRecord::class);
    }

    public function ecoScores()
    {
        return $this->hasMany(EcoScore::class);
    }

    public function challenges()
    {
        return $this->belongsToMany(Challenge::class, 'user_challenges')
                    ->withPivot('status', 'progress', 'completed_at')
                    ->withTimestamps();
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
                    ->withPivot('earned_at')
                    ->withTimestamps();
    }

    public function monthlyTargets()
    {
        return $this->hasMany(MonthlyTarget::class);
    }
}
