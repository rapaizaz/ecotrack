@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">AI Monthly Insight ✨</h1>
            <p class="text-slate-500">Analisis cerdas berdasarkan pemakaian listrik, air, dan sampahmu bulan ini.</p>
        </div>
        <form action="{{ route('ai.insight.generate') }}" method="POST">
            @csrf
            <button type="submit" class="bg-emerald-600 text-white px-8 py-3 rounded-2xl font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100 flex items-center gap-2">
                <i class="fas fa-magic"></i> {{ $insight ? 'Perbarui Insight' : 'Generate Insight' }}
            </button>
        </form>
    </div>

    @if($insight)
        <div class="space-y-8 animate-in fade-in duration-700">
            <!-- Main Insight Card -->
            <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-right from-emerald-500 to-blue-500"></div>
                <div class="p-10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">Laporan Analisis AI</h3>
                            <p class="text-sm text-slate-400 font-medium">Periode: {{ now()->translatedFormat('F Y') }}</p>
                        </div>
                    </div>

                    <div class="prose prose-slate max-w-none prose-p:leading-relaxed prose-p:text-slate-600 prose-li:text-slate-600">
                        {!! str($insight->insight)->markdown() !!}
                    </div>
                </div>
                
                <div class="bg-slate-50 px-10 py-6 border-t border-slate-100 flex justify-between items-center">
                    <p class="text-xs text-slate-400 italic">Disusun secara otomatis oleh EcoTrack AI pada {{ $insight->updated_at->format('d M Y, H:i') }}</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-white border border-slate-200 rounded-full text-[10px] font-bold text-slate-500 uppercase">Gemini 1.5 Flash</span>
                    </div>
                </div>
            </div>

            <!-- Suggestion Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-emerald-50 rounded-3xl p-6 border border-emerald-100">
                    <div class="w-10 h-10 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4 class="font-bold text-emerald-900 mb-2">Tips Hemat</h4>
                    <p class="text-xs text-emerald-700 leading-relaxed">Cek rekomendasi di atas untuk langkah praktis mengurangi tagihan listrikmu.</p>
                </div>
                <div class="bg-blue-50 rounded-3xl p-6 border border-blue-100">
                    <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-tint"></i>
                    </div>
                    <h4 class="font-bold text-blue-900 mb-2">Konservasi Air</h4>
                    <p class="text-xs text-blue-700 leading-relaxed">AI mendeteksi potensi penghematan air pada aktivitas harianmu.</p>
                </div>
                <div class="bg-amber-50 rounded-3xl p-6 border border-amber-100">
                    <div class="w-10 h-10 bg-amber-600 text-white rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-recycle"></i>
                    </div>
                    <h4 class="font-bold text-amber-900 mb-2">Kurangi Sampah</h4>
                    <p class="text-xs text-amber-700 leading-relaxed">Tingkatkan skor lingkunganmu dengan memilah sampah lebih konsisten.</p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-[2rem] border-2 border-dashed border-slate-200 p-20 text-center">
            <div class="w-24 h-24 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center text-4xl mb-6 mx-auto">
                <i class="fas fa-magic"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-800 mb-3">Belum Ada Insight Bulan Ini</h3>
            <p class="text-slate-500 max-w-md mx-auto mb-10">Klik tombol di atas untuk memerintahkan AI menganalisis data pemakaian lingkunganmu dan memberikan saran cerdas.</p>
            <div class="flex flex-col gap-3 max-w-xs mx-auto text-left">
                <div class="flex items-center gap-3 text-sm text-slate-400">
                    <i class="fas fa-check-circle text-emerald-500"></i> Analisis Listrik
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-400">
                    <i class="fas fa-check-circle text-emerald-500"></i> Analisis Air & Sampah
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-400">
                    <i class="fas fa-check-circle text-emerald-500"></i> Rekomendasi Personal
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
