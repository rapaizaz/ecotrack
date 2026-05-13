@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900">Analisis Eco Score 📊</h1>
    <p class="text-slate-500">Lihat rincian penilaian gaya hidup ramah lingkunganmu.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <!-- Main Score Circle -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm flex flex-col items-center justify-center text-center">
        <div class="relative w-48 h-48 mb-6">
            <svg class="w-full h-full -rotate-90">
                <circle cx="96" cy="96" r="88" stroke="currentColor" stroke-width="12" fill="transparent" class="text-slate-100" />
                <circle cx="96" cy="96" r="88" stroke="currentColor" stroke-width="12" fill="transparent" class="text-emerald-500" stroke-dasharray="552.92" stroke-dashoffset="{{ 552.92 * (1 - ($ecoScore->total_score ?? 0) / 100) }}" stroke-linecap="round" />
            </svg>
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-5xl font-bold text-slate-900">{{ $ecoScore->total_score ?? '0' }}</span>
                <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Skor</span>
            </div>
        </div>
        <h3 class="text-2xl font-bold text-emerald-600 mb-2">{{ $ecoScore->status ?? 'Belum ada data' }}</h3>
        <p class="text-slate-500 text-sm">Update terakhir: {{ $ecoScore ? $ecoScore->updated_at->format('d M Y') : '-' }}</p>
    </div>

    <!-- Breakdown Cards -->
    <div class="lg:col-span-2 space-y-4">
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-6">
            <div class="w-16 h-16 rounded-2xl bg-yellow-50 text-yellow-600 flex items-center justify-center text-2xl">
                <i class="fas fa-bolt"></i>
            </div>
            <div class="flex-1">
                <div class="flex justify-between mb-2">
                    <span class="font-bold text-slate-700">Skor Listrik</span>
                    <span class="font-bold text-yellow-600">{{ $ecoScore->electricity_score ?? '0' }}/100</span>
                </div>
                <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                    <div class="bg-yellow-400 h-full rounded-full" style="width: {{ $ecoScore->electricity_score ?? 0 }}%"></div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-6">
            <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                <i class="fas fa-tint"></i>
            </div>
            <div class="flex-1">
                <div class="flex justify-between mb-2">
                    <span class="font-bold text-slate-700">Skor Air</span>
                    <span class="font-bold text-blue-600">{{ $ecoScore->water_score ?? '0' }}/100</span>
                </div>
                <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                    <div class="bg-blue-500 h-full rounded-full" style="width: {{ $ecoScore->water_score ?? 0 }}%"></div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-6">
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl">
                <i class="fas fa-recycle"></i>
            </div>
            <div class="flex-1">
                <div class="flex justify-between mb-2">
                    <span class="font-bold text-slate-700">Skor Sampah</span>
                    <span class="font-bold text-emerald-600">{{ $ecoScore->waste_score ?? '0' }}/100</span>
                </div>
                <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full" style="width: {{ $ecoScore->waste_score ?? 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recommendations -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
        <h3 class="text-xl font-bold mb-6 flex items-center gap-3">
            <i class="fas fa-lightbulb text-yellow-500"></i> Rekomendasi Khusus Kamu
        </h3>
        <div class="space-y-4">
            @foreach($recommendations as $rec)
            <div class="p-5 bg-emerald-50 border border-emerald-100 rounded-2xl flex gap-4">
                <div class="text-emerald-600 text-xl"><i class="fas fa-circle-check"></i></div>
                <div>
                    <p class="text-slate-800 font-medium leading-relaxed">{{ $rec }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Score History -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
        <h3 class="text-xl font-bold mb-6">Riwayat Skor Bulanan</h3>
        <div class="space-y-4">
            @forelse($history as $h)
            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center font-bold text-slate-600">
                        {{ $h->month }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-700">{{ date('F', mktime(0, 0, 0, $h->month, 1)) }} {{ $h->year }}</p>
                        <p class="text-xs text-slate-500">{{ $h->status }}</p>
                    </div>
                </div>
                <div class="text-xl font-bold text-emerald-600">{{ $h->total_score }}</div>
            </div>
            @empty
            <p class="text-center py-8 text-slate-400">Belum ada riwayat skor.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
