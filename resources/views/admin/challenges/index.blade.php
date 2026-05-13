@extends('layouts.app')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-slate-900">Kelola Challenge 🏆</h1>
        <p class="text-slate-500">Buat tantangan lingkungan baru untuk memotivasi pengguna.</p>
    </div>
    <a href="{{ route('admin.challenges.create') }}" class="bg-emerald-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-200">
        <i class="fas fa-plus mr-2"></i> Tambah Challenge
    </a>
</div>

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-xs font-bold text-slate-400 uppercase tracking-widest bg-slate-50 border-b border-slate-200">
                    <th class="px-8 py-5">Challenge</th>
                    <th class="px-8 py-5">Kategori</th>
                    <th class="px-8 py-5">Target</th>
                    <th class="px-8 py-5">Poin</th>
                    <th class="px-8 py-5">Status</th>
                    <th class="px-8 py-5">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($challenges as $challenge)
                <tr class="hover:bg-slate-50 transition-all">
                    <td class="px-8 py-5">
                        <p class="font-bold text-slate-900">{{ $challenge->title }}</p>
                        <p class="text-xs text-slate-500">{{ Str::limit($challenge->description, 50) }}</p>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full">{{ $challenge->category }}</span>
                    </td>
                    <td class="px-8 py-5 font-medium text-slate-700">
                        {{ $challenge->target_value }} {{ $challenge->category == 'Listrik' ? 'kWh' : ($challenge->category == 'Air' ? 'm³' : 'kg') }}
                    </td>
                    <td class="px-8 py-5 font-bold text-emerald-600">+{{ $challenge->points }}</td>
                    <td class="px-8 py-5">
                        @if(\Carbon\Carbon::now()->between($challenge->start_date, $challenge->end_date))
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-full uppercase">Aktif</span>
                        @else
                            <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-bold rounded-full uppercase">Berakhir</span>
                        @endif
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.challenges.edit', $challenge->id) }}" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.challenges.destroy', $challenge->id) }}" method="POST" onsubmit="return confirm('Hapus challenge ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
