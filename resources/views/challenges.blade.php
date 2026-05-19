@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900">Eco Challenges 🏆</h1>
    <p class="text-slate-500">Ikuti tantangan seru untuk membangun gaya hidup lebih hijau.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <div class="space-y-6">
        <h2 class="text-xl font-bold text-slate-800">Tantangan Sedang Diikuti</h2>
        @forelse($userChallenges->where('pivot.status', 'ongoing') as $challenge)
        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div class="flex gap-4">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fas fa-{{ $challenge->category === 'Listrik' ? 'bolt' : ($challenge->category === 'Air' ? 'tint' : 'trash-alt') }}"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">{{ $challenge->title }}</h3>
                        <p class="text-sm text-slate-500">{{ $challenge->category }} • {{ $challenge->points }} Poin</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">Ongoing</span>
            </div>
            <p class="text-sm text-slate-600 mb-6">{{ $challenge->description }}</p>
            
            <div class="mb-6">
                <div class="flex justify-between text-xs font-bold text-slate-400 mb-2">
                    <span>PROGRESS</span>
                    <span>{{ $challenge->pivot->progress }} / {{ $challenge->target_value }}</span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full transition-all duration-500" style="width: {{ min(100, ($challenge->pivot->progress / $challenge->target_value) * 100) }}%"></div>
                </div>
            </div>

            <form action="{{ route('challenges.progress', $challenge->id) }}" method="POST" class="flex gap-2">
                @csrf
                <input type="number" name="progress" value="{{ $challenge->pivot->progress }}" class="flex-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-emerald-500">
                <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-emerald-700 transition-all">Update</button>
            </form>
        </div>
        @empty
        <div class="bg-slate-100 rounded-3xl p-12 text-center border-2 border-dashed border-slate-200">
            <div class="text-4xl text-slate-300 mb-4"><i class="fas fa-tasks"></i></div>
            <p class="text-slate-500 font-medium">Belum ada tantangan aktif.</p>
            <p class="text-slate-400 text-sm">Pilih salah satu tantangan di sebelah kanan untuk memulai!</p>
        </div>
        @endforelse

        <h2 class="text-xl font-bold text-slate-800 pt-4">Tantangan Selesai</h2>
        @foreach($userChallenges->where('pivot.status', 'completed') as $challenge)
        <div class="bg-emerald-50 rounded-3xl p-6 border border-emerald-100 shadow-sm opacity-80">
            <div class="flex justify-between items-center">
                <div class="flex gap-4">
                    <div class="w-12 h-12 bg-white text-emerald-600 rounded-xl flex items-center justify-center text-xl shadow-sm">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800">{{ $challenge->title }}</h3>
                        <p class="text-xs text-slate-500">Selesai pada {{ \Carbon\Carbon::parse($challenge->pivot->completed_at)->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="text-emerald-700 font-bold text-lg">+{{ $challenge->points }} pts</div>
            </div>
        </div>
        @endforeach
    </div>

    
    <div class="space-y-6">
        <h2 class="text-xl font-bold text-slate-800">Tantangan Tersedia</h2>
        @foreach($allChallenges as $challenge)
            @if(!$userChallenges->contains($challenge->id))
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:border-emerald-300 transition-all group">
                <div class="flex gap-6">
                    <div class="w-16 h-16 bg-slate-50 text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600 rounded-2xl flex items-center justify-center text-3xl transition-all">
                        <i class="fas fa-{{ $challenge->category === 'Listrik' ? 'bolt' : ($challenge->category === 'Air' ? 'tint' : 'trash-alt') }}"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between mb-1">
                            <h3 class="font-bold text-xl group-hover:text-emerald-700 transition-all">{{ $challenge->title }}</h3>
                            <span class="text-emerald-600 font-bold">+{{ $challenge->points }} Poin</span>
                        </div>
                        <p class="text-slate-500 text-sm mb-6 leading-relaxed">{{ $challenge->description }}</p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-400">
                                <i class="fas fa-calendar-alt"></i> 
                                Berakhir: {{ \Carbon\Carbon::parse($challenge->end_date)->format('d M Y') }}
                            </div>
                            <form action="{{ route('challenges.join', $challenge->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-white border-2 border-emerald-600 text-emerald-600 px-6 py-2 rounded-full text-sm font-bold hover:bg-emerald-600 hover:text-white transition-all">
                                    Ikuti Tantangan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
