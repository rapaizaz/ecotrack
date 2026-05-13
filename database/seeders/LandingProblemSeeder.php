<?php

namespace Database\Seeders;

use App\Models\LandingProblem;
use Illuminate\Database\Seeder;

class LandingProblemSeeder extends Seeder
{
    public function run(): void
    {
        $problems = [
            [
                'title' => 'Boros Listrik',
                'description' => 'Penggunaan perangkat elektronik yang tidak efisien menyebabkan tagihan membengkak dan emisi karbon tinggi.',
                'icon_class' => 'fas fa-bolt',
                'bg_color_class' => 'yellow',
            ],
            [
                'title' => 'Pemakaian Air Berlebih',
                'description' => 'Kebocoran kran dan penggunaan air yang tidak terkontrol mengancam ketersediaan sumber daya air bersih.',
                'icon_class' => 'fas fa-tint',
                'bg_color_class' => 'blue',
            ],
            [
                'title' => 'Sampah Tak Terkelola',
                'description' => 'Sampah rumah tangga yang tidak dipilah menumpuk di TPA dan mencemari ekosistem lingkungan sekitar.',
                'icon_class' => 'fas fa-trash-alt',
                'bg_color_class' => 'red',
            ],
        ];

        foreach ($problems as $problem) {
            LandingProblem::create($problem);
        }
    }
}
