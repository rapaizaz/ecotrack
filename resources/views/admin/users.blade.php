@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900">Kelola User 👥</h1>
    <p class="text-slate-500">Daftar semua pengguna terdaftar di platform EcoTrack.</p>
</div>

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-xs font-bold text-slate-400 uppercase tracking-widest bg-slate-50 border-b border-slate-200">
                    <th class="px-8 py-5">User</th>
                    <th class="px-8 py-5">Kontak</th>
                    <th class="px-8 py-5">Total Data</th>
                    <th class="px-8 py-5">Status</th>
                    <th class="px-8 py-5">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50 transition-all">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center font-bold text-xl">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-900">{{ $user->name }}</p>
                                <p class="text-xs text-slate-500">Joined {{ $user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <p class="text-sm text-slate-700 font-medium">{{ $user->email }}</p>
                        <p class="text-xs text-slate-400">{{ $user->phone ?? '-' }}</p>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex gap-2">
                            <span class="text-xs font-bold px-2 py-1 bg-yellow-50 text-yellow-600 rounded-lg">⚡ {{ $user->electricity_usages_count }}</span>
                            <span class="text-xs font-bold px-2 py-1 bg-blue-50 text-blue-600 rounded-lg">💧 {{ $user->water_usages_count }}</span>
                            <span class="text-xs font-bold px-2 py-1 bg-emerald-50 text-emerald-600 rounded-lg">♻️ {{ $user->waste_records_count }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full uppercase tracking-tighter">Active</span>
                    </td>
                    <td class="px-8 py-5">
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition-all">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
