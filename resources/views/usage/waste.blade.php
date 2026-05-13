@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Catat Data Sampah ♻️</h1>
        <p class="text-slate-500">Mulai pilah dan catat sampah harianmu untuk bumi yang lebih bersih.</p>
    </div>

    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('waste.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Organik (kg)</label>
                    <input type="number" step="0.01" name="organic_kg" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Plastik (kg)</label>
                    <input type="number" step="0.01" name="plastic_kg" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kertas (kg)</label>
                    <input type="number" step="0.01" name="paper_kg" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Logam (kg)</label>
                    <input type="number" step="0.01" name="metal_kg" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Lainnya (kg)</label>
                <input type="number" step="0.01" name="other_kg" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-slate-700 mb-2">Catatan (Opsional)</label>
                <textarea name="notes" rows="3" placeholder="Misal: Sisa makanan acara keluarga..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none"></textarea>
            </div>

            <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 flex items-center justify-center gap-2">
                Simpan Catatan Sampah <i class="fas fa-save"></i>
            </button>
        </form>
    </div>

    <div class="mt-8 bg-emerald-50 border border-emerald-100 rounded-2xl p-6">
        <h4 class="font-bold text-emerald-800 flex items-center gap-2 mb-2">
            <i class="fas fa-info-circle"></i> Pentingnya Memilah
        </h4>
        <p class="text-sm text-emerald-700">
            Total sampah di bawah 10kg per bulan akan memberimu skor 100! Memilah sampah memudahkan proses pengolahan kembali dan mengurangi pencemaran tanah.
        </p>
    </div>
</div>
@endsection
