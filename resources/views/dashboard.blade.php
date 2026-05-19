@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-slate-900">Halo, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-slate-500">Mari pantau perkembangan gaya hidup ramah lingkunganmu hari ini.</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('ai.assistant') }}" class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-emerald-100 transition-all flex items-center gap-2">
            <i class="fas fa-robot"></i> Tanya AI Assistant
        </a>
        <a href="{{ route('electricity.index') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-all flex items-center gap-2 shadow-lg shadow-emerald-100">
            <i class="fas fa-plus"></i> Catat Aktivitas
        </a>
    </div>
</div>


<div class="mb-8 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-6 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 overflow-hidden relative">
    <div class="absolute -right-10 -top-10 opacity-10 text-9xl rotate-12">
        <i class="fas fa-brain"></i>
    </div>
    <div class="flex items-center gap-4 relative z-10">
        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center text-3xl backdrop-blur-md border border-white/30">
            <i class="fas fa-magic"></i>
        </div>
        <div>
            <h3 class="text-xl font-bold">AI Eco Insight</h3>
            <p class="text-blue-100 text-sm">Dapatkan analisis cerdas dan rekomendasi personal dari AI.</p>
        </div>
    </div>
    <a href="{{ route('ai.insight') }}" class="w-full md:w-auto bg-white text-indigo-700 px-8 py-3 rounded-2xl font-bold hover:bg-blue-50 transition-all shadow-lg text-center relative z-10">
        Lihat Insight AI
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    
    <div class="lg:col-span-2 bg-gradient-to-br from-emerald-600 to-teal-700 rounded-3xl p-8 text-white shadow-xl shadow-emerald-200 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 text-9xl">
            <i class="fas fa-leaf"></i>
        </div>
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
            <div class="flex-1 text-center md:text-left">
                <h3 class="text-emerald-100 font-medium mb-1 uppercase tracking-wider">Eco Score Bulan Ini</h3>
                <div class="text-6xl font-bold mb-4">{{ $ecoScore->total_score ?? '0' }}<span class="text-2xl opacity-70">/100</span></div>
                <div class="inline-block px-4 py-1.5 bg-emerald-500/30 rounded-full text-sm font-semibold border border-emerald-400/30 mb-6">
                    <i class="fas fa-star text-yellow-300 mr-2"></i> {{ $ecoScore->status ?? 'Belum ada data' }}
                </div>
                <p class="text-emerald-50 leading-relaxed max-w-md">
                    {{ $ecoScore ? 'Terus pertahankan kebiasaan baikmu. Setiap langkah kecil sangat berarti untuk bumi kita.' : 'Catat penggunaan listrik, air, dan sampahmu bulan ini untuk melihat skor lingkunganmu!' }}
                </p>
            </div>
            <div class="w-48 h-48 bg-white/10 rounded-full flex items-center justify-center border-4 border-white/20 backdrop-blur-sm relative">
                <div class="text-center">
                    <div class="text-4xl font-bold">{{ $ecoScore->total_score ?? '0' }}%</div>
                    <div class="text-xs uppercase tracking-widest text-emerald-100">Optimal</div>
                </div>
                
                <svg class="absolute inset-0 w-full h-full -rotate-90">
                    <circle cx="96" cy="96" r="88" stroke="currentColor" stroke-width="8" fill="transparent" class="text-white/10" />
                    <circle cx="96" cy="96" r="88" stroke="currentColor" stroke-width="8" fill="transparent" class="text-emerald-300" stroke-dasharray="552.92" stroke-dashoffset="{{ 552.92 * (1 - ($ecoScore->total_score ?? 0) / 100) }}" />
                </svg>
            </div>
        </div>
    </div>

    
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
        <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
            <i class="fas fa-calendar-check text-emerald-600"></i> Ringkasan {{ \Carbon\Carbon::now()->format('F Y') }}
        </h3>
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-yellow-50 text-yellow-600 flex items-center justify-center text-xl">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="flex-1">
                    <p class="text-slate-500 text-sm">Listrik</p>
                    <p class="font-bold text-lg">{{ $electricity->kwh ?? '0' }} <span class="text-sm font-normal text-slate-400">kWh</span></p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-400">Score</p>
                    <p class="font-bold text-emerald-600">{{ $ecoScore->electricity_score ?? '0' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="flex-1">
                    <p class="text-slate-500 text-sm">Air</p>
                    <p class="font-bold text-lg">{{ $water->cubic_meter ?? '0' }} <span class="text-sm font-normal text-slate-400">m³</span></p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-400">Score</p>
                    <p class="font-bold text-emerald-600">{{ $ecoScore->water_score ?? '0' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                    <i class="fas fa-recycle"></i>
                </div>
                <div class="flex-1">
                    <p class="text-slate-500 text-sm">Sampah</p>
                    <p class="font-bold text-lg">{{ $totalWaste }} <span class="text-sm font-normal text-slate-400">kg</span></p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-400">Score</p>
                    <p class="font-bold text-emerald-600">{{ $ecoScore->waste_score ?? '0' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-2 bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-xl font-bold text-slate-900">Grafik Penggunaan</h3>
            <div class="flex gap-2">
                <span class="flex items-center gap-1.5 text-xs font-semibold text-slate-500 px-3 py-1 bg-slate-50 rounded-full border border-slate-100">
                    <span class="w-2 h-2 rounded-full bg-yellow-400"></span> Listrik
                </span>
                <span class="flex items-center gap-1.5 text-xs font-semibold text-slate-500 px-3 py-1 bg-slate-50 rounded-full border border-slate-100">
                    <span class="w-2 h-2 rounded-full bg-blue-400"></span> Air
                </span>
                <span class="flex items-center gap-1.5 text-xs font-semibold text-slate-500 px-3 py-1 bg-slate-50 rounded-full border border-slate-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span> Sampah
                </span>
            </div>
        </div>
        <div class="h-80">
            <canvas id="usageChart"></canvas>
        </div>
    </div>

    
    <div class="space-y-8">
        
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold mb-6 flex items-center gap-2">
                <i class="fas fa-lightbulb text-yellow-500"></i> Rekomendasi
            </h3>
            <div class="space-y-4">
                @foreach($recommendations as $rec)
                <div class="flex gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <div class="mt-1 text-emerald-600"><i class="fas fa-check-circle"></i></div>
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $rec }}</p>
                </div>
                @endforeach
            </div>
        </div>

        
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
             <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold flex items-center gap-2">
                    <i class="fas fa-award text-emerald-600"></i> Badge Terbaru
                </h3>
                <a href="{{ route('badges') }}" class="text-emerald-600 text-xs font-bold hover:underline">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-4 gap-4">
                @forelse($recentBadges as $badge)
                <div class="text-center" title="{{ $badge->name }}">
                    <div class="w-12 h-12 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xl mb-1 shadow-sm shadow-emerald-100">
                        <i class="fas fa-{{ $badge->icon }}"></i>
                    </div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase truncate">{{ $badge->name }}</p>
                </div>
                @empty
                <div class="col-span-4 text-center py-4 text-slate-400 text-sm">Belum ada badge. Ayo mulai catat data!</div>
                @endforelse
            </div>
        </div>
    </div>
</div>


<div class="mt-8 bg-white rounded-3xl p-6 md:p-8 border border-slate-200 shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-slate-900">Aktivitas Terbaru</h3>
        <a href="{{ route('history') }}" class="text-emerald-600 text-xs font-bold hover:underline">Lihat Riwayat</a>
    </div>
    
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-slate-100">
                    <th class="pb-4">Tipe Aktivitas</th>
                    <th class="pb-4">Nilai Input</th>
                    <th class="pb-4">Tanggal</th>
                    <th class="pb-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($history as $item)
                <tr class="group hover:bg-slate-50/50 transition-all">
                    <td class="py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-{{ $item['color'] }}-50 text-{{ $item['color'] }}-600 flex items-center justify-center shadow-sm">
                                <i class="fas fa-{{ $item['type'] === 'Listrik' ? 'bolt' : ($item['type'] === 'Air' ? 'tint' : 'trash-alt') }}"></i>
                            </div>
                            <span class="font-bold text-slate-700 tracking-tight">{{ $item['type'] }}</span>
                        </div>
                    </td>
                    <td class="py-5 font-bold text-slate-900">{{ $item['value'] }}</td>
                    <td class="py-5 text-slate-500 text-sm font-medium">{{ $item['date']->format('d M Y, H:i') }}</td>
                    <td class="py-5">
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-extrabold rounded-full uppercase tracking-wider">Selesai</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-12 text-center text-slate-400 font-medium">Belum ada aktivitas. Silakan masukkan data penggunaan pertama kamu!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="md:hidden space-y-4">
        @forelse($history as $item)
        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-{{ $item['color'] }}-100 text-{{ $item['color'] }}-600 flex items-center justify-center text-xl shadow-sm">
                <i class="fas fa-{{ $item['type'] === 'Listrik' ? 'bolt' : ($item['type'] === 'Air' ? 'tint' : 'trash-alt') }}"></i>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-1">
                    <span class="font-bold text-slate-900 tracking-tight">{{ $item['type'] }}</span>
                    <span class="text-[10px] font-extrabold text-emerald-600 uppercase tracking-widest">Selesai</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-bold text-slate-600">{{ $item['value'] }}</span>
                    <span class="text-[10px] font-medium text-slate-400">{{ $item['date']->format('d M Y') }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="py-12 text-center text-slate-400 font-medium bg-slate-50 rounded-2xl border border-dashed border-slate-200">
            Belum ada aktivitas terbaru.
        </div>
        @endforelse
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('usageChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartData['labels']),
                datasets: [
                    {
                        label: 'Listrik (kWh)',
                        data: @json($chartData['electricity']),
                        borderColor: '#fbbf24',
                        backgroundColor: 'rgba(251, 191, 36, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Air (m³)',
                        data: @json($chartData['water']),
                        borderColor: '#60a5fa',
                        backgroundColor: 'rgba(96, 165, 250, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Sampah (kg)',
                        data: @json($chartData['waste']),
                        borderColor: '#34d399',
                        backgroundColor: 'rgba(52, 211, 153, 0.1)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>
@endsection
