@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Edit Tips 💡</h1>
        <p class="text-slate-500">Perbarui informasi tips ramah lingkungan.</p>
    </div>

    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('admin.tips.update', $tip->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Judul Tips</label>
                <input type="text" name="title" value="{{ $tip->title }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                <select name="category" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">
                    <option value="Listrik" {{ $tip->category == 'Listrik' ? 'selected' : '' }}>Listrik</option>
                    <option value="Air" {{ $tip->category == 'Air' ? 'selected' : '' }}>Air</option>
                    <option value="Sampah" {{ $tip->category == 'Sampah' ? 'selected' : '' }}>Sampah</option>
                    <option value="Umum" {{ $tip->category == 'Umum' ? 'selected' : '' }}>Umum</option>
                </select>
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-slate-700 mb-2">Konten Tips</label>
                <textarea name="content" rows="5" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none">{{ $tip->content }}</textarea>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.tips.index') }}" class="flex-1 text-center bg-slate-100 text-slate-600 font-bold py-4 rounded-2xl hover:bg-slate-200 transition-all">Batal</a>
                <button type="submit" class="flex-[2] bg-emerald-600 text-white font-bold py-4 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200">
                    Perbarui Tips
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
