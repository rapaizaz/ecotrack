@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900">Riwayat Catatan 📚</h1>
    <p class="text-slate-500">Semua rekaman aktivitas penggunaan energimu.</p>
</div>

<div class="space-y-8">
    <!-- Electricity History -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <i class="fas fa-bolt text-yellow-500"></i> Riwayat Listrik
            </h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr class="text-left text-xs font-bold text-slate-400 uppercase tracking-widest">
                        <th class="px-6 py-4">Periode</th>
                        <th class="px-6 py-4">Penggunaan (kWh)</th>
                        <th class="px-6 py-4">Biaya (Rp)</th>
                        <th class="px-6 py-4">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($electricity as $item)
                    <tr class="hover:bg-slate-50 transition-all">
                        <td class="px-6 py-4 font-bold">{{ date('F', mktime(0, 0, 0, $item->month, 1)) }} {{ $item->year }}</td>
                        <td class="px-6 py-4">{{ $item->kwh }}</td>
                        <td class="px-6 py-4">Rp{{ number_format($item->cost, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500 italic">{{ $item->notes ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-slate-400 italic">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Water History -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <i class="fas fa-tint text-blue-500"></i> Riwayat Air
            </h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr class="text-left text-xs font-bold text-slate-400 uppercase tracking-widest">
                        <th class="px-6 py-4">Periode</th>
                        <th class="px-6 py-4">Penggunaan (m³)</th>
                        <th class="px-6 py-4">Biaya (Rp)</th>
                        <th class="px-6 py-4">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($water as $item)
                    <tr class="hover:bg-slate-50 transition-all">
                        <td class="px-6 py-4 font-bold">{{ date('F', mktime(0, 0, 0, $item->month, 1)) }} {{ $item->year }}</td>
                        <td class="px-6 py-4">{{ $item->cubic_meter }}</td>
                        <td class="px-6 py-4">Rp{{ number_format($item->cost, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500 italic">{{ $item->notes ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-slate-400 italic">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
