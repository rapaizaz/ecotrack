@extends('layouts.app')

@section('content')
<div class="mb-8 p-5 md:p-8 bg-white rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group">
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-emerald-50 rounded-full blur-3xl opacity-50 group-hover:bg-emerald-100 transition-colors duration-1000"></div>
    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                    <i class="fas fa-file-contract text-lg"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Laporan Bulanan</h1>
            </div>
            <p class="text-slate-500 font-medium md:ml-13 text-sm md:text-base">Analisis performa keberlanjutanmu untuk periode ini.</p>
        </div>
        <div class="w-full lg:w-auto">
            <form action="{{ route('monthly-report') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 bg-slate-50 p-2 rounded-2xl md:rounded-full border border-slate-100">
                <div class="flex items-center gap-2 flex-1">
                    <div class="flex items-center gap-1 px-3 flex-1 sm:flex-none">
                        <i class="fas fa-calendar-alt text-slate-400 text-sm"></i>
                        <select name="month" class="bg-transparent border-none text-sm font-bold text-slate-700 outline-none focus:ring-0 cursor-pointer w-full sm:w-auto">
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="hidden sm:block w-px h-6 bg-slate-200"></div>
                    <div class="flex items-center gap-1 px-3 flex-1 sm:flex-none">
                        <i class="fas fa-clock text-slate-400 text-sm"></i>
                        <select name="year" class="bg-transparent border-none text-sm font-bold text-slate-700 outline-none focus:ring-0 cursor-pointer w-full sm:w-auto">
                            @foreach(range(2024, 2026) as $y)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="bg-slate-900 text-white px-6 py-3 sm:py-2.5 rounded-xl md:rounded-full text-xs font-bold hover:bg-emerald-600 transition-all hover:shadow-lg hover:shadow-emerald-200 flex items-center justify-center gap-2">
                    <i class="fas fa-filter"></i> Terapkan
                </button>
            </form>
        </div>
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
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm text-center card-hover relative overflow-hidden group">
            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-emerald-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <h3 class="text-slate-400 font-bold text-xs uppercase tracking-widest mb-6 relative z-10">Eco Score</h3>
            <div class="text-7xl font-bold text-slate-900 mb-2 relative z-10">{{ $score->total_score }}</div>
            <div class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold mb-6 relative z-10 animate-pulse">
                {{ $score->status }}
            </div>
            <div class="pt-6 border-t border-slate-100 relative z-10">
                <p class="text-[10px] font-bold text-slate-400 uppercase mb-4 tracking-tighter">Perbandingan Performa</p>
                <div class="flex items-center justify-center gap-2">
                    @if($prev_score)
                        @php $diff = $score->total_score - $prev_score->total_score; @endphp
                        @if($diff > 0)
                            <div class="flex flex-col items-center">
                                <span class="text-emerald-600 font-bold text-lg"><i class="fas fa-caret-up"></i> {{ $diff }}</span>
                                <span class="text-[9px] text-slate-400 uppercase font-bold">Peningkatan</span>
                            </div>
                        @elseif($diff < 0)
                            <div class="flex flex-col items-center">
                                <span class="text-red-500 font-bold text-lg"><i class="fas fa-caret-down"></i> {{ abs($diff) }}</span>
                                <span class="text-[9px] text-slate-400 uppercase font-bold">Penurunan</span>
                            </div>
                        @else
                            <span class="text-slate-500 font-bold">Stabil</span>
                        @endif
                    @else
                        <span class="text-slate-400 font-medium italic text-sm">Laporan Pertama</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-emerald-600 rounded-3xl p-6 text-white shadow-xl shadow-emerald-200/50 relative overflow-hidden group">
            <div class="absolute right-0 bottom-0 opacity-20 transform translate-x-1/4 translate-y-1/4 group-hover:rotate-45 transition-transform duration-700">
                <i class="fas fa-leaf text-8xl"></i>
            </div>
            <h4 class="font-bold text-[10px] uppercase tracking-widest mb-3 opacity-80 flex items-center gap-2">
                <i class="fas fa-quote-left text-[8px]"></i> Kesimpulan AI
            </h4>
            <p class="text-sm leading-relaxed font-medium">
                "{{ $conclusion }}"
            </p>
        </div>

        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden group border border-slate-700/50">
            <div class="absolute -right-4 -top-4 opacity-10 text-6xl group-hover:rotate-12 transition-transform duration-500">
                <i class="fas fa-magic"></i>
            </div>
            <div class="absolute top-4 right-4">
                <span class="px-2 py-1 bg-emerald-500/20 text-emerald-400 rounded text-[9px] font-bold border border-emerald-500/30">PREMIUM</span>
            </div>
            <h3 class="font-bold mb-4 flex items-center gap-2 text-lg">
                <i class="fas fa-robot text-emerald-400"></i> AI Report Summary
            </h3>
            <div id="ai-summary-content" class="text-xs text-slate-400 leading-relaxed mb-6 min-h-[60px] border-l-2 border-emerald-500/30 pl-4 italic">
                Sistem AI kami siap memberikan ringkasan mendalam tentang konsumsi energimu bulan ini.
            </div>
            <button id="btn-generate-ai" onclick="generateAISummary()" class="w-full bg-emerald-600 text-white py-4 rounded-2xl text-xs font-bold hover:bg-emerald-500 transition-all shadow-lg shadow-emerald-900/50 flex items-center justify-center gap-3 group/btn">
                <i class="fas fa-wand-sparkles group-hover/btn:animate-pulse"></i> Generate AI Insight
            </button>
        </div>
    </div>

    <div class="lg:col-span-3 space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm card-hover group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-yellow-50 text-yellow-500 flex items-center justify-center text-xl shadow-inner group-hover:scale-110 transition-transform">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Electricity</span>
                </div>
                <div class="text-3xl font-bold text-slate-900 mb-1 tracking-tight">{{ $electricity->kwh ?? '0' }} <span class="text-sm font-normal text-slate-400">kWh</span></div>
                <div class="flex items-center gap-2">
                    <p class="text-xs font-bold text-slate-500">Rp{{ number_format($electricity->cost ?? 0, 0, ',', '.') }}</p>
                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                    <p class="text-[10px] text-slate-400">Estimasi Tagihan</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm card-hover group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center text-xl shadow-inner group-hover:scale-110 transition-transform">
                        <i class="fas fa-tint"></i>
                    </div>
                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Water Usage</span>
                </div>
                <div class="text-3xl font-bold text-slate-900 mb-1 tracking-tight">{{ $water->cubic_meter ?? '0' }} <span class="text-sm font-normal text-slate-400">m³</span></div>
                <div class="flex items-center gap-2">
                    <p class="text-xs font-bold text-slate-500">Rp{{ number_format($water->cost ?? 0, 0, ',', '.') }}</p>
                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                    <p class="text-[10px] text-slate-400">Estimasi Tagihan</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm card-hover group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl shadow-inner group-hover:scale-110 transition-transform">
                        <i class="fas fa-recycle"></i>
                    </div>
                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Waste Output</span>
                </div>
                <div class="text-3xl font-bold text-slate-900 mb-1 tracking-tight">{{ $totalWaste }} <span class="text-sm font-normal text-slate-400">kg</span></div>
                <div class="flex items-center gap-2">
                    <p class="text-xs font-bold text-slate-500">Total Terpilah</p>
                    <span class="w-1 h-1 bg-emerald-500 rounded-full"></span>
                    <p class="text-[10px] text-emerald-600 font-bold">Ramah Lingkungan</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 left-0 w-1 h-full bg-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="font-bold text-slate-800">Visualisasi Skor & Konsumsi</h3>
                    <p class="text-xs text-slate-400">Perbandingan efisiensi antar kategori</p>
                </div>
                <div class="flex gap-2">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="text-[10px] font-bold text-slate-500">Target Tercapai</span>
                    </div>
                </div>
            </div>
            <div class="h-80">
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
