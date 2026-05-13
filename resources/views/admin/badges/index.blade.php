@extends('layouts.app')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-slate-900">Kelola Badge 🎖️</h1>
        <p class="text-slate-500">Atur lencana penghargaan untuk pencapaian pengguna.</p>
    </div>
    <a href="{{ route('admin.badges.create') }}" class="bg-emerald-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-200">
        <i class="fas fa-plus mr-2"></i> Tambah Badge
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($badges as $badge)
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm text-center">
        <div class="w-20 h-20 mx-auto bg-emerald-100 text-emerald-600 rounded-3xl flex items-center justify-center text-3xl mb-4 shadow-lg shadow-emerald-50">
            <i class="fas fa-{{ $badge->icon }}"></i>
        </div>
        <h3 class="font-bold text-slate-800 mb-1">{{ $badge->name }}</h3>
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-4">{{ $badge->requirement_type }}</p>
        <p class="text-xs text-slate-500 mb-6 leading-relaxed">{{ $badge->description }}</p>
        
        <div class="flex gap-2 pt-4 border-t border-slate-50">
            <a href="{{ route('admin.badges.edit', $badge->id) }}" class="flex-1 bg-slate-50 text-slate-600 py-2 rounded-xl text-xs font-bold hover:bg-slate-100">Edit</a>
            <form action="{{ route('admin.badges.destroy', $badge->id) }}" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-50 text-red-500 py-2 rounded-xl text-xs font-bold hover:bg-red-100">Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
