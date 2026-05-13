@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900">Achievement Badges 🎖️</h1>
    <p class="text-slate-500">Kumpulkan semua lencana penghargaan atas kontribusi hijaumu.</p>
</div>

<div class="bg-white rounded-3xl p-10 border border-slate-200 shadow-sm">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10">
        @foreach($allBadges as $badge)
        @php $isEarned = in_array($badge->id, $userBadges); @endphp
        <div class="text-center group">
            <div class="relative inline-block mb-4">
                <!-- Badge Glow -->
                @if($isEarned)
                <div class="absolute inset-0 bg-emerald-400 blur-2xl opacity-20 group-hover:opacity-40 transition-all rounded-full"></div>
                @endif

                <div class="w-24 h-24 mx-auto {{ $isEarned ? 'bg-gradient-to-br from-emerald-500 to-teal-600 text-white' : 'bg-slate-100 text-slate-400 grayscale' }} rounded-3xl flex items-center justify-center text-4xl shadow-xl relative transition-all duration-500 group-hover:scale-110">
                    <i class="fas fa-{{ $badge->icon }}"></i>
                    @if($isEarned)
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 text-emerald-900 rounded-full flex items-center justify-center text-sm font-bold border-4 border-white">
                            <i class="fas fa-check"></i>
                        </div>
                    @else
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-slate-200 text-slate-400 rounded-full flex items-center justify-center text-sm border-4 border-white">
                            <i class="fas fa-lock"></i>
                        </div>
                    @endif
                </div>
            </div>
            <h3 class="font-bold text-slate-800 {{ $isEarned ? '' : 'opacity-60' }}">{{ $badge->name }}</h3>
            <p class="text-[10px] text-slate-500 font-medium uppercase tracking-widest mt-1">{{ $badge->requirement_type }}</p>
            <p class="text-xs text-slate-400 mt-2 px-4 leading-relaxed {{ $isEarned ? '' : 'opacity-50' }}">{{ $badge->description }}</p>
            
            @if($isEarned)
            <p class="text-[10px] font-bold text-emerald-600 mt-3">Didapatkan pada {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
            @else
            <div class="mt-3 w-16 h-1 mx-auto bg-slate-100 rounded-full overflow-hidden">
                <div class="bg-slate-300 h-full w-0"></div>
            </div>
            <p class="text-[10px] font-bold text-slate-300 mt-1">BELUM TERBUKA</p>
            @endif
        </div>
        @endforeach
    </div>
</div>

<div class="mt-12 bg-gradient-to-r from-emerald-600 to-teal-700 rounded-3xl p-10 text-white flex flex-col md:flex-row items-center gap-8 shadow-xl shadow-emerald-200">
    <div class="text-5xl opacity-50"><i class="fas fa-info-circle"></i></div>
    <div class="flex-1 text-center md:text-left">
        <h3 class="text-2xl font-bold mb-2">Cara Mendapatkan Badge?</h3>
        <p class="text-emerald-50 leading-relaxed">
            Lencana didapatkan secara otomatis saat kamu mencapai target tertentu dalam monitoring lingkunganmu. 
            Semakin rajin kamu mencatat dan semakin hemat penggunaan energimu, semakin banyak lencana yang bisa kamu kumpulkan!
        </p>
    </div>
    <a href="{{ route('electricity.index') }}" class="bg-white text-emerald-700 px-8 py-3 rounded-full font-bold hover:bg-emerald-50 transition-all whitespace-nowrap">Mulai Catat Sekarang</a>
</div>
@endsection
