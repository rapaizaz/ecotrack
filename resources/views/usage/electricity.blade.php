@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Catat Penggunaan Listrik ⚡</h1>
        <p class="text-slate-500">Masukkan data tagihan listrikmu untuk memantau efisiensi energi.</p>
    </div>

    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('electricity.store') }}" method="POST">
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
                <label class="block text-sm font-bold text-slate-700 mb-2">Total Penggunaan (kWh)</label>
                <div class="relative">
                    <input type="number" step="0.01" name="kwh" placeholder="0.00" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none pl-12">
                    <div class="absolute left-4 top-3.5 text-slate-400">
                        <i class="fas fa-bolt"></i>
                    </div>
                </div>
                @error('kwh') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
                <textarea name="notes" rows="3" placeholder="Misal: Banyak lembur di rumah, penggunaan AC meningkat..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none"></textarea>
            </div>

            <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 flex items-center justify-center gap-2">
                Simpan Data <i class="fas fa-save"></i>
            </button>
        </form>
    </div>

    <div class="mt-8 bg-yellow-50 border border-yellow-100 rounded-2xl p-6">
        <h4 class="font-bold text-yellow-800 flex items-center gap-2 mb-2">
            <i class="fas fa-info-circle"></i> Tips Hemat Listrik
        </h4>
        <p class="text-sm text-yellow-700">
            Usahakan penggunaan listrik di bawah 100 kWh per bulan untuk mendapatkan skor maksimal (100). Matikan perangkat elektronik yang tidak digunakan!
        </p>
    </div>
</div>
@endsection
