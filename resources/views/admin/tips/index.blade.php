@extends('layouts.app')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-slate-900">Kelola Tips Hemat 💡</h1>
        <p class="text-slate-500">Buat dan atur tips ramah lingkungan untuk pengguna.</p>
    </div>
    <a href="{{ route('admin.tips.create') }}" class="bg-emerald-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-200">
        <i class="fas fa-plus mr-2"></i> Tambah Tips
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($tips as $tip)
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-start mb-4">
                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-full uppercase tracking-widest">{{ $tip->category }}</span>
                <form action="{{ route('admin.tips.toggle', $tip->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-{{ $tip->is_active ? 'emerald' : 'slate' }}-500 text-xl">
                        <i class="fas fa-toggle-{{ $tip->is_active ? 'on' : 'off' }}"></i>
                    </button>
                </form>
            </div>
            <h3 class="font-bold text-lg text-slate-800 mb-2">{{ $tip->title }}</h3>
            <p class="text-sm text-slate-500 mb-6 leading-relaxed">{{ $tip->content }}</p>
        </div>
        <div class="flex gap-2 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.tips.edit', $tip->id) }}" class="flex-1 bg-slate-50 text-slate-600 text-center py-2 rounded-xl text-sm font-bold hover:bg-slate-100">Edit</a>
            <form action="{{ route('admin.tips.destroy', $tip->id) }}" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-50 text-red-500 py-2 rounded-xl text-sm font-bold hover:bg-red-100">Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
