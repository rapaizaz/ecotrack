@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-slate-900">Laporan Bulanan 📄</h1>
        <p class="text-slate-500">Evaluasi menyeluruh penggunaan energimu bulan ini.</p>
    </div>
    <div class="flex gap-2">
        <form action="{{ route('monthly-report') }}" method="GET" class="flex gap-2">
            <select name="month" class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-emerald-500">
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                @endforeach
            </select>
            <select name="year" class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-emerald-500">
                @foreach(range(2024, 2026) as $y)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-emerald-700">Filter</button>
        </form>
    </div>
</div>

@if($no_data)
<div class="bg-white rounded-3xl p-16 text-center border border-slate-200 shadow-sm">
    <div class="text-6xl text-slate-200 mb-6"><i class="fas fa-file-invoice"></i></div>
    <h2 class="text-2xl font-bold text-slate-800 mb-2">Belum Ada Data Laporan</h2>
    <p class="text-slate-500 max-w-md mx-auto mb-8">Silakan masukkan data penggunaan listrik, air, atau sampah untuk bulan {{ date('F', mktime(0, 0, 0, $month, 1)) }} {{ $year }} terlebih dahulu.</p>
    <a href="{{ route('electricity.index') }}" class="bg-emerald-600 text-white px-8 py-3 rounded-full font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-200">Catat Sekarang</a>
</div>
@else
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Score Summary Card -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm text-center">
            <h3 class="text-slate-400 font-bold text-xs uppercase tracking-widest mb-6">Eco Score</h3>
            <div class="text-6xl font-bold text-slate-900 mb-2">{{ $score->total_score }}</div>
            <div class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold mb-6">
                {{ $score->status }}
            </div>
            <div class="pt-6 border-t border-slate-100">
                <p class="text-xs font-bold text-slate-400 uppercase mb-4">Perbandingan</p>
                <div class="flex items-center justify-center gap-2">
                    @if($prev_score)
                        @php $diff = $score->total_score - $prev_score->total_score; @endphp
                        @if($diff > 0)
                            <span class="text-emerald-600 font-bold"><i class="fas fa-arrow-up"></i> {{ $diff }} poin</span>
                        @elseif($diff < 0)
                            <span class="text-red-500 font-bold"><i class="fas fa-arrow-down"></i> {{ abs($diff) }} poin</span>
                        @else
                            <span class="text-slate-500 font-bold">Stabil</span>
                        @endif
                    @else
                        <span class="text-slate-400 font-medium">Laporan Pertama</span>
                    @endif
                </div>
            </div>
        </div>

            <p class="text-sm text-emerald-100 leading-relaxed italic">
                "{{ $conclusion }}"
            </p>
        </div>

        <!-- AI Report Summary -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
            <div class="absolute -right-4 -top-4 opacity-10 text-6xl">
                <i class="fas fa-magic"></i>
            </div>
            <h3 class="font-bold mb-4 flex items-center gap-2">
                <i class="fas fa-robot text-emerald-400"></i> AI Report Summary
            </h3>
            <div id="ai-summary-content" class="text-xs text-slate-300 leading-relaxed mb-6 min-h-[60px]">
                Klik tombol di bawah untuk membuat ringkasan laporan berbasis AI.
            </div>
            <button id="btn-generate-ai" onclick="generateAISummary()" class="w-full bg-emerald-600 text-white py-3 rounded-2xl text-xs font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-black/20 flex items-center justify-center gap-2">
                <i class="fas fa-wand-sparkles"></i> Generate AI Summary
            </button>
        </div>
    </div>

    <!-- Details Section -->
    <div class="lg:col-span-3 space-y-8">
        <!-- Usage Comparison Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-yellow-50 text-yellow-600 flex items-center justify-center"><i class="fas fa-bolt"></i></div>
                    <span class="font-bold text-slate-700">Listrik</span>
                </div>
                <div class="text-2xl font-bold text-slate-900 mb-1">{{ $electricity->kwh ?? '0' }} kWh</div>
                <p class="text-xs text-slate-500">Tagihan: Rp{{ number_format($electricity->cost ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center"><i class="fas fa-tint"></i></div>
                    <span class="font-bold text-slate-700">Air</span>
                </div>
                <div class="text-2xl font-bold text-slate-900 mb-1">{{ $water->cubic_meter ?? '0' }} m³</div>
                <p class="text-xs text-slate-500">Tagihan: Rp{{ number_format($water->cost ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center"><i class="fas fa-recycle"></i></div>
                    <span class="font-bold text-slate-700">Sampah</span>
                </div>
                <div class="text-2xl font-bold text-slate-900 mb-1">{{ $totalWaste }} kg</div>
                <p class="text-xs text-slate-500">Total berat terpilah</p>
            </div>
        </div>

        <!-- Progress Chart Comparison (Simplified) -->
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
            <h3 class="font-bold text-slate-800 mb-6">Statistik Bulan Ini</h3>
            <div class="h-64">
                <canvas id="monthlyStatsChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    function generateAISummary() {
        const btn = document.getElementById('btn-generate-ai');
        const content = document.getElementById('ai-summary-content');
        const originalText = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menganalisis...';
        content.innerHTML = '<div class="flex items-center gap-2"><span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> EcoTrack AI sedang mempelajari datamu...</div>';

        fetch("{{ route('monthly-report.ai-summary') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                month: '{{ $month }}',
                year: '{{ $year }}'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.summary) {
                content.innerHTML = data.summary;
                btn.innerHTML = '<i class="fas fa-check"></i> Selesai';
            } else {
                content.innerHTML = 'Gagal membuat ringkasan. AI Insight sedang tidak tersedia, sistem menampilkan rekomendasi otomatis.';
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        })
        .catch(error => {
            content.innerHTML = 'Error: Terjadi kesalahan pada server.';
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('monthlyStatsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Listrik Score', 'Air Score', 'Sampah Score', 'Total Eco Score'],
                datasets: [{
                    label: 'Skor',
                    data: [{{ $score->electricity_score }}, {{ $score->water_score }}, {{ $score->waste_score }}, {{ $score->total_score }}],
                    backgroundColor: [
                        'rgba(251, 191, 36, 0.6)',
                        'rgba(59, 130, 246, 0.6)',
                        'rgba(16, 185, 129, 0.6)',
                        'rgba(5, 150, 105, 0.8)'
                    ],
                    borderRadius: 12
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, max: 100, grid: { color: '#f1f5f9' } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>
@endif
@endsection
