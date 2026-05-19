@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900">Admin Dashboard 🛡️</h1>
    <p class="text-slate-500">Statistik global dan manajemen platform EcoTrack.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase">Total User</p>
                <p class="text-2xl font-bold text-slate-900">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center text-xl">
                <i class="fas fa-bolt"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase">Input Listrik</p>
                <p class="text-2xl font-bold text-slate-900">{{ $totalElectricity }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl">
                <i class="fas fa-leaf"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase">Avg Eco Score</p>
                <p class="text-2xl font-bold text-slate-900">{{ round($avgEcoScore, 1) }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-xl">
                <i class="fas fa-trophy"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase">Active Challenges</p>
                <p class="text-2xl font-bold text-slate-900">{{ \App\Models\Challenge::count() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
        <h3 class="text-xl font-bold mb-6">Perkembangan Eco Score Global</h3>
        <div class="h-80">
            <canvas id="globalStatsChart"></canvas>
        </div>
    </div>

    
    <div class="space-y-6">
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-8 text-white">
            <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                <i class="fas fa-star text-yellow-400"></i> Top Eco User
            </h3>
            @if($topUser)
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center text-3xl font-bold border-4 border-white/20">
                    {{ substr($topUser->name, 0, 1) }}
                </div>
                <div>
                    <h4 class="text-2xl font-bold">{{ $topUser->name }}</h4>
                    <p class="text-emerald-400 font-bold text-lg">Skor: {{ $topUser->ecoScores->first()->total_score ?? '0' }}</p>
                    <p class="text-slate-400 text-sm">Bergabung sejak {{ $topUser->created_at->format('M Y') }}</p>
                </div>
            </div>
            @else
            <p class="text-slate-500 italic">Belum ada data user.</p>
            @endif
        </div>

        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                <i class="fas fa-fire text-red-500"></i> Challenge Terpopuler
            </h3>
            @if($popularChallenge)
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="font-bold text-slate-800">{{ $popularChallenge->title }}</h4>
                    <p class="text-sm text-slate-500">{{ $popularChallenge->users_count }} Peserta aktif</p>
                </div>
                <div class="text-emerald-600 font-bold text-xl"><i class="fas fa-users"></i></div>
            </div>
            @else
            <p class="text-slate-500 italic">Belum ada data challenge.</p>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('globalStatsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($monthlyStats->pluck('label')),
                datasets: [{
                    label: 'Rata-rata Skor Global',
                    data: @json($monthlyStats->pluck('avg_score')),
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, max: 100 }
                }
            }
        });
    });
</script>
@endsection
