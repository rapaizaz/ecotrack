@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Catat Penggunaan Air 💧</h1>
        <p class="text-slate-500">Pantau pemakaian air m³ kamu untuk mendukung konservasi air.</p>
    </div>

    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('water.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Bulan</label>
                    <select name="month" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ old('month', date('n')) == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Tahun</label>
                    <input type="number" name="year" value="{{ old('year', date('Y')) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Volume Air (m³)</label>
                <div class="relative">
                    <input type="number" step="0.01" name="cubic_meter" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none pl-12">
                    <div class="absolute left-4 top-3.5 text-slate-400">
                        <i class="fas fa-tint text-blue-500"></i>
                    </div>
                </div>
                @error('cubic_meter') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Biaya (Rp)</label>
                <div class="relative">
                    <input type="number" name="cost" placeholder="0" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none pl-12">
                    <div class="absolute left-4 top-3.5 text-slate-400">
                        <span class="font-bold text-sm">Rp</span>
                    </div>
                </div>
                @error('cost') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-slate-700 mb-2">Catatan (Opsional)</label>
                <textarea name="notes" rows="3" placeholder="Misal: Menyiram taman lebih sering bulan ini..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                Simpan Data <i class="fas fa-save"></i>
            </button>
        </form>
    </div>

    <div class="mt-8 bg-blue-50 border border-blue-100 rounded-2xl p-6">
        <h4 class="font-bold text-blue-800 flex items-center gap-2 mb-2">
            <i class="fas fa-info-circle"></i> Tips Hemat Air
        </h4>
        <p class="text-sm text-blue-700">
            Gunakan air di bawah 10 m³ per bulan untuk mendapatkan skor maksimal. Tutup rapat kran setelah digunakan dan perbaiki kebocoran sekecil apa pun!
        </p>
    </div>
</div>
@endsection
