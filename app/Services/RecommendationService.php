<?php

namespace App\Services;

class RecommendationService
{
    public function getRecommendations($ecoScore)
    {
        $recommendations = [];

        if (!$ecoScore) return ["Mulai catat penggunaan listrik, air, dan sampahmu untuk mendapatkan rekomendasi."];

        if ($ecoScore->electricity_score < 60) {
            $recommendations[] = "Kurangi penggunaan AC";
            $recommendations[] = "Matikan lampu saat tidak digunakan";
            $recommendations[] = "Cabut perangkat elektronik dari stop kontak";
        }

        if ($ecoScore->water_score < 60) {
            $recommendations[] = "Kurangi waktu mandi";
            $recommendations[] = "Perbaiki kran bocor";
            $recommendations[] = "Gunakan air secukupnya saat mencuci";
        }

        if ($ecoScore->waste_score < 60) {
            $recommendations[] = "Pisahkan sampah organik dan anorganik";
            $recommendations[] = "Kurangi plastik sekali pakai";
            $recommendations[] = "Gunakan tas belanja sendiri";
        }

        if ($ecoScore->total_score >= 85) {
            $recommendations[] = "Kebiasaanmu sudah sangat baik. Pertahankan gaya hidup ramah lingkungan ini.";
        }

        if (empty($recommendations)) {
            $recommendations[] = "Teruskan kebiasaan baikmu dan coba tingkatkan lagi di bulan depan!";
        }

        return $recommendations;
    }
}
