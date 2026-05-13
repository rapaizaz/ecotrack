<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tip;

class TipSeeder extends Seeder
{
    public function run(): void
    {
        $tips = [
            ['title' => 'Cabut charger saat tidak digunakan', 'category' => 'Listrik', 'content' => 'Charger yang tetap tercolok meskipun tidak mengisi daya tetap mengonsumsi listrik (vampire power).'],
            ['title' => 'Gunakan lampu LED', 'category' => 'Listrik', 'content' => 'Lampu LED jauh lebih hemat energi dan tahan lama dibanding lampu pijar atau CFL.'],
            ['title' => 'Matikan kran saat tidak dipakai', 'category' => 'Air', 'content' => 'Jangan biarkan air mengalir saat menggosok gigi atau menyabuni tangan.'],
            ['title' => 'Gunakan botol minum sendiri', 'category' => 'Sampah', 'content' => 'Mengurangi penggunaan botol plastik sekali pakai sangat membantu mengurangi beban sampah plastik.'],
            ['title' => 'Pisahkan sampah organik dan plastik', 'category' => 'Sampah', 'content' => 'Pemisahan sampah memudahkan proses daur ulang dan pembuatan kompos.'],
        ];

        foreach ($tips as $tip) {
            Tip::create($tip);
        }
    }
}
