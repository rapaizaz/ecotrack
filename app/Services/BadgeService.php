<?php

namespace App\Services;

use App\Models\Badge;
use App\Models\EcoScore;
use App\Models\UserBadge;
use Carbon\Carbon;

class BadgeService
{
    public function checkAndAwardBadges($user, $month, $year)
    {
        $ecoScore = EcoScore::where('user_id', $user->id)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        if (!$ecoScore) return;

        
        $this->awardBadge($user, 'Eco Starter');

        
        if ($ecoScore->electricity_score >= 80) {
            $this->awardBadge($user, 'Hemat Listrik');
        }

        
        if ($ecoScore->water_score >= 80) {
            $this->awardBadge($user, 'Hemat Air');
        }

        
        if ($ecoScore->waste_score >= 80) {
            $this->awardBadge($user, 'Zero Plastic');
        }

        
        if ($ecoScore->total_score >= 85) {
            $this->awardBadge($user, 'Eco Warrior');
        }
    }

    private function awardBadge($user, $badgeName)
    {
        $badge = Badge::where('name', $badgeName)->first();
        if ($badge && !$user->badges()->where('badge_id', $badge->id)->exists()) {
            $user->badges()->attach($badge->id, ['earned_at' => Carbon::now()]);
        }
    }
}
