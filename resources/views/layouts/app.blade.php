<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'EcoTrack') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .sidebar-link.active { background-color: #ecfdf5; color: #059669; border-right: 4px solid #059669; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .card-hover:hover { transform: translateY(-5px); transition: all 0.3s ease; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="text-slate-800" x-data="{ mobileMenu: false }">
    <div class="flex h-screen overflow-hidden">
        
        @auth
        
        <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/50 z-40 md:hidden backdrop-blur-sm" @click="mobileMenu = false" x-cloak></div>

        <aside :class="mobileMenu ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" class="fixed md:relative inset-y-0 left-0 w-64 bg-white border-r border-slate-200 flex flex-col z-50 transition-transform duration-300 ease-in-out">
            <div class="p-6 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm border border-slate-100 overflow-hidden">
                        <img src="{{ asset('asset/image/logo1.png') }}" alt="EcoTrack Logo" class="w-full h-full object-contain" style="mix-blend-mode: multiply;">
                    </div>
                    <span class="text-xl font-bold text-slate-900 tracking-tight">Eco<span class="text-emerald-600">Track</span></span>
                </a>
                <button @click="mobileMenu = false" class="md:hidden text-slate-400 hover:text-slate-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
                @if(Auth::user()->role === 'user')
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-th-large w-5"></i> Dashboard
                    </a>
                    <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Input Data</div>
                    <a href="{{ route('electricity.index') }}" class="sidebar-link {{ request()->routeIs('electricity.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-bolt w-5 text-yellow-500"></i> Listrik
                    </a>
                    <a href="{{ route('water.index') }}" class="sidebar-link {{ request()->routeIs('water.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-tint w-5 text-blue-500"></i> Air
                    </a>
                    <a href="{{ route('waste.index') }}" class="sidebar-link {{ request()->routeIs('waste.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-trash-alt w-5 text-emerald-500"></i> Sampah
                    </a>
                    <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Aktivitas</div>
                    <a href="{{ route('history') }}" class="sidebar-link {{ request()->routeIs('history') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-history w-5"></i> Riwayat
                    </a>
                    <a href="{{ route('eco-score') }}" class="sidebar-link {{ request()->routeIs('eco-score') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-chart-line w-5"></i> Eco Score
                    </a>
                    <a href="{{ route('challenges.index') }}" class="sidebar-link {{ request()->routeIs('challenges.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-trophy w-5"></i> Challenge
                    </a>
                    <a href="{{ route('badges') }}" class="sidebar-link {{ request()->routeIs('badges') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-award w-5"></i> Badge
                    </a>
                    <a href="{{ route('monthly-report') }}" class="sidebar-link {{ request()->routeIs('monthly-report') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-file-alt w-5"></i> Laporan
                    </a>
                    <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">AI Features</div>
                    <a href="{{ route('ai.assistant') }}" class="sidebar-link {{ request()->routeIs('ai.assistant') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-robot w-5 text-emerald-600"></i> AI Assistant
                    </a>
                    <a href="{{ route('ai.insight') }}" class="sidebar-link {{ request()->routeIs('ai.insight') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-magic w-5 text-blue-600"></i> AI Insight
                    </a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-chart-pie w-5"></i> Admin Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-users w-5"></i> Kelola User
                    </a>
                    <a href="{{ route('admin.tips.index') }}" class="sidebar-link {{ request()->routeIs('admin.tips.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-lightbulb w-5"></i> Kelola Tips
                    </a>
                    <a href="{{ route('admin.challenges.index') }}" class="sidebar-link {{ request()->routeIs('admin.challenges.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-tasks w-5"></i> Kelola Challenge
                    </a>
                    <a href="{{ route('admin.badges.index') }}" class="sidebar-link {{ request()->routeIs('admin.badges.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-medal w-5"></i> Kelola Badge
                    </a>
                    <a href="{{ route('admin.landing-settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.landing-settings.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="fas fa-image w-5"></i> Kelola Landing
                    </a>
                @endif
            </nav>
            <div class="p-4 border-t border-slate-100">
                <a href="{{ route('profile') }}" class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition-all text-left">
                    <div class="w-10 h-10 rounded-full bg-[#f0f2f5] flex items-end justify-center overflow-hidden border border-slate-200">
                        <i class="fas fa-user text-[#bfc5c9] text-2xl mb-[-3px]"></i>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ Auth::user()->role }}</p>
                    </div>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-all">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>
        @endauth

        
        <main class="flex-1 overflow-y-auto bg-slate-50 relative">
            @auth
            <header class="h-16 bg-white border-b border-slate-200 sticky top-0 z-50 flex items-center justify-between px-8 md:hidden">
                 <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm border border-slate-100 overflow-hidden">
                        <img src="{{ asset('asset/image/logo1.png') }}" alt="EcoTrack Logo" class="w-full h-full object-contain" style="mix-blend-mode: multiply;">
                    </div>
                    <span class="text-lg font-bold text-slate-900 tracking-tight">Eco<span class="text-emerald-600">Track</span></span>
                </a>
                <button @click="mobileMenu = true" class="text-slate-600 text-2xl hover:text-emerald-600 transition-all"><i class="fas fa-bars"></i></button>
            </header>
            @endauth

            <div class="p-4 md:p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-100 text-emerald-700 rounded-xl border border-emerald-200 flex items-center gap-3 animate-bounce">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
