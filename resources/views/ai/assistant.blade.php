@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">AI Eco Assistant 🍃</h1>
        <p class="text-slate-500">Tanyakan apapun tentang gaya hidup hemat dan ramah lingkungan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 space-y-6">
            
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm flex flex-col h-[600px]">
                <div class="flex-1 overflow-y-auto p-6 space-y-6" id="chat-container">
                    @forelse($conversations->reverse() as $chat)
                        
                        <div class="flex justify-end">
                            <div class="bg-emerald-600 text-white px-6 py-3 rounded-2xl rounded-tr-none max-w-[80%] shadow-md">
                                <p class="text-sm font-medium">{{ $chat->question }}</p>
                                <p class="text-[10px] opacity-70 mt-1 text-right">{{ $chat->created_at->format('H:i') }}</p>
                            </div>
                        </div>

                        
                        <div class="flex justify-start">
                            <div class="bg-slate-50 text-slate-800 px-6 py-4 rounded-2xl rounded-tl-none max-w-[80%] border border-slate-100 shadow-sm">
                                <div class="flex items-center justify-between gap-4 mb-2">
                                    <div class="flex items-center gap-2 text-emerald-600">
                                        <i class="fas fa-robot"></i>
                                        <span class="text-xs font-bold uppercase tracking-widest">Eco Assistant</span>
                                    </div>
                                    @if(isset($chat->provider) && $chat->provider && strtolower($chat->provider) !== 'offline')
                                        <span class="px-2 py-0.5 bg-emerald-100/50 rounded-full text-[9px] font-bold text-emerald-700 uppercase tracking-wider">{{ strtolower($chat->provider) === 'gemini' ? 'F3R' : $chat->provider }}</span>
                                    @else
                                        <span class="px-2 py-0.5 bg-slate-200/60 rounded-full text-[9px] font-bold text-slate-500 uppercase tracking-wider">Offline</span>
                                    @endif
                                </div>
                                <div class="text-sm leading-relaxed prose prose-sm max-w-none">
                                    {!! nl2br(e($chat->answer)) !!}
                                </div>
                                <p class="text-[10px] text-slate-400 mt-2">{{ $chat->created_at->format('H:i') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex flex-col items-center justify-center text-center p-8">
                            <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-3xl mb-4">
                                <i class="fas fa-comments"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 mb-2">Halo! Saya Eco Assistant</h3>
                            <p class="text-sm text-slate-500 max-w-xs">Tanyakan saya cara menghemat tagihan listrik, cara mengolah sampah, atau tips hidup hijau lainnya.</p>
                        </div>
                    @endforelse
                </div>

                
                <div class="p-4 border-t border-slate-100">
                    <form action="{{ route('ai.assistant.ask') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="text" name="question" required 
                            class="flex-1 bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-emerald-500 outline-none text-sm" 
                            placeholder="Tanya sesuatu... (contoh: Bagaimana cara hemat listrik AC?)">
                        <button type="submit" class="bg-emerald-600 text-white w-14 rounded-2xl flex items-center justify-center hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-emerald-900 text-white rounded-3xl p-8 relative overflow-hidden">
                <div class="absolute -right-4 -top-4 opacity-10 text-8xl">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="text-xl font-bold mb-4 relative z-10">EcoBot AI</h3>
                <p class="text-emerald-100/80 text-sm leading-relaxed relative z-10 mb-6">
                    Asisten pribadi berbasis AI untuk membantu kamu mencapai target keberlanjutan. Jawaban AI didasarkan pada praktik terbaik penghematan energi.
                </p>
                <div class="space-y-3 relative z-10">
                    <div class="flex items-center gap-3 text-sm">
                        <i class="fas fa-bolt text-yellow-400"></i> Tips Hemat Energi
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <i class="fas fa-tint text-blue-400"></i> Konservasi Air
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <i class="fas fa-recycle text-emerald-400"></i> Manajemen Sampah
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
                <h4 class="font-bold text-slate-800 mb-4">Mungkin Kamu Ingin Tanya:</h4>
                <div class="space-y-2">
                    <button onclick="document.querySelector('input[name=question]').value='Cara memilah sampah rumah tangga'" class="w-full text-left px-4 py-3 rounded-xl bg-slate-50 text-xs text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all border border-transparent hover:border-emerald-100">
                        "Cara memilah sampah rumah tangga"
                    </button>
                    <button onclick="document.querySelector('input[name=question]').value='Tips menghemat air saat mandi'" class="w-full text-left px-4 py-3 rounded-xl bg-slate-50 text-xs text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all border border-transparent hover:border-emerald-100">
                        "Tips menghemat air saat mandi"
                    </button>
                    <button onclick="document.querySelector('input[name=question]').value='Alat elektronik yang paling boros'" class="w-full text-left px-4 py-3 rounded-xl bg-slate-50 text-xs text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all border border-transparent hover:border-emerald-100">
                        "Alat elektronik yang paling boros"
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const container = document.getElementById('chat-container');
    container.scrollTop = container.scrollHeight;
</script>
@endsection
