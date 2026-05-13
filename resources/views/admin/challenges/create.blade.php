@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Tambah Challenge Baru 🏆</h1>
        <p class="text-slate-500">Buat tantangan seru untuk para pejuang lingkungan.</p>
    </div>

    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('admin.challenges.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Judul Challenge</label>
                <input type="text" name="title" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none" placeholder="Contoh: Hemat Listrik 10%">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                <select name="category" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                    <option value="Listrik">Listrik</option>
                    <option value="Air">Air</option>
                    <option value="Sampah">Sampah</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Target Nilai</label>
                    <input type="number" step="0.01" name="target_value" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none" placeholder="0.00">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Poin Hadiah</label>
                    <input type="number" name="points" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none" placeholder="100">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Berakhir</label>
                    <input type="date" name="end_date" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Challenge</label>
                <textarea name="description" rows="4" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none" placeholder="Jelaskan detail tantangan dan cara menyelesaikannya..."></textarea>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.challenges.index') }}" class="flex-1 text-center bg-slate-100 text-slate-600 font-bold py-4 rounded-2xl hover:bg-slate-200 transition-all">Batal</a>
                <button type="submit" class="flex-[2] bg-emerald-600 text-white font-bold py-4 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200">
                    Simpan Challenge
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
