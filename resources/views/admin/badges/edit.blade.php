@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Edit Badge 🎖️</h1>
        <p class="text-slate-500">Perbarui detail lencana penghargaan.</p>
    </div>

    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('admin.badges.update', $badge->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Badge</label>
                <input type="text" name="name" value="{{ $badge->name }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Ikon FontAwesome</label>
                <div class="relative">
                    <input type="text" name="icon" value="{{ $badge->icon }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none pl-12">
                    <div class="absolute left-4 top-3.5 text-slate-400"><i class="fas fa-search"></i></div>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Tipe Persyaratan</label>
                <select name="requirement_type" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                    <option value="first_input" {{ $badge->requirement_type == 'first_input' ? 'selected' : '' }}>Input Pertama</option>
                    <option value="high_score" {{ $badge->requirement_type == 'high_score' ? 'selected' : '' }}>Skor Tinggi (90+)</option>
                    <option value="consecutive_inputs" {{ $badge->requirement_type == 'consecutive_inputs' ? 'selected' : '' }}>Input Berturut-turut</option>
                    <option value="challenge_completed" {{ $badge->requirement_type == 'challenge_completed' ? 'selected' : '' }}>Challenge Selesai</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Nilai Persyaratan (Target)</label>
                <input type="number" name="requirement_value" value="{{ $badge->requirement_value }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="3" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">{{ $badge->description }}</textarea>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.badges.index') }}" class="flex-1 text-center bg-slate-100 text-slate-600 font-bold py-4 rounded-2xl hover:bg-slate-200 transition-all">Batal</a>
                <button type="submit" class="flex-[2] bg-emerald-600 text-white font-bold py-4 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200">
                    Perbarui Badge
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
