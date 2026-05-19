<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrack - Solusi Digital Lingkungan Berkelanjutan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Outfit', sans-serif; }
        .gradient-text { background: linear-gradient(to right, #059669, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-bg { background-image: radial-gradient(circle at 2px 2px, rgba(16, 185, 129, 0.1) 1px, transparent 0); background-size: 40px 40px; }
    </style>
</head>
<body class="bg-white text-slate-800">
    
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm border border-slate-100 overflow-hidden">
                        <img src="{{ asset('asset/image/logo1.png') }}" alt="EcoTrack Logo" class="w-full h-full object-contain" style="mix-blend-mode: multiply;">
                    </div>
                    <span class="text-2xl font-bold text-slate-900 tracking-tight">Eco<span class="text-emerald-600">Track</span></span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-slate-600 hover:text-emerald-600 font-medium">Home</a>
                    <a href="#fitur" class="text-slate-600 hover:text-emerald-600 font-medium">Fitur</a>
                    <a href="#cara-kerja" class="text-slate-600 hover:text-emerald-600 font-medium">Cara Kerja</a>
                    <a href="#manfaat" class="text-slate-600 hover:text-emerald-600 font-medium">Manfaat</a>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-emerald-600 text-white px-6 py-2.5 rounded-full font-semibold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-600 font-semibold hover:text-emerald-600">Login</a>
                        <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-6 py-2.5 rounded-full font-semibold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200">Mulai Sekarang</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    
    <section id="home" class="pt-32 pb-20 hero-bg overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-full text-sm font-bold mb-6">
                        <span class="flex h-2 w-2 rounded-full bg-emerald-600 animate-pulse"></span>
                        Solusi Cerdas Lingkungan Modern
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-bold text-slate-900 leading-tight mb-6">
                        Pantau Kebiasaanmu, <br>
                        <span class="gradient-text">Kurangi Dampak Lingkungan</span>
                    </h1>
                    <p class="text-lg text-slate-600 mb-8 max-w-xl mx-auto lg:mx-0">
                        EcoTrack membantu kamu mencatat penggunaan listrik, air, dan sampah untuk membangun gaya hidup hemat, ramah lingkungan, dan berkelanjutan secara digital.
                    </p>
                    
                    
                    <div class="flex items-center justify-center lg:justify-start gap-4 mb-10">
                        <div class="flex -space-x-3">
                            @foreach($latestUsers as $user)
                                <div class="inline-block h-12 w-12 rounded-full ring-4 ring-white bg-[#f0f2f5] flex items-end justify-center overflow-hidden">
                                    <i class="fas fa-user text-[#bfc5c9] text-3xl mb-[-4px]"></i>
                                </div>
                            @endforeach
                            
                            @if($totalUsers > 3)
                                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-emerald-100 ring-4 ring-white text-emerald-600 font-bold text-sm">
                                    +{{ $totalUsers - 3 }}
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <p class="text-slate-900 font-bold text-xl leading-tight">
                                Tergabung dengan <span class="text-emerald-600 border-b-4 border-emerald-200">{{ $totalUsers }}</span> pahlawan lingkungan
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto bg-emerald-600 text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-emerald-700 transition-all shadow-xl shadow-emerald-200 flex items-center justify-center gap-2">
                            Mulai Sekarang <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="#fitur" class="w-full sm:w-auto bg-white text-slate-700 border-2 border-slate-200 px-10 py-4 rounded-full font-bold text-lg hover:border-emerald-600 hover:text-emerald-600 transition-all flex items-center justify-center gap-2">
                            Lihat Fitur
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2 relative">
                    <div class="absolute -top-10 -right-10 w-64 h-64 bg-emerald-200 rounded-full blur-3xl opacity-30"></div>
                    <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-blue-200 rounded-full blur-3xl opacity-30"></div>
                    <img src="{{ ($landingSetting && $landingSetting->hero_image_path) ? asset('storage/' . $landingSetting->hero_image_path) : 'https://img.freepik.com/free-vector/dashboard-interface-user-panel-template-with-charts-data-analysis_107791-3142.jpg' }}" alt="EcoTrack Dashboard" class="relative rounded-3xl shadow-2xl border-8 border-white">
                </div>
            </div>
        </div>
    </section>

    
    <section id="fitur" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-slate-900 mb-4">Masalah yang Kita Hadapi</h2>
            <p class="text-slate-600 max-w-2xl mx-auto mb-12">Banyak orang tidak menyadari betapa besarnya dampak kebiasaan sehari-hari terhadap lingkungan karena kurangnya pemantauan data.</p>
            <div class="grid md:grid-cols-3 gap-8 text-left">
                @foreach($problems as $problem)
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="h-48 bg-{{ $problem->bg_color_class ?? 'emerald' }}-50 relative overflow-hidden">
                        @if($problem->image_path)
                            <img src="{{ asset('storage/' . $problem->image_path) }}" alt="{{ $problem->title }}" class="w-full h-full object-cover">
                        @else
                            
                            @php $defaultImages = [
                                    'Boros Listrik' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&q=80&w=800',
                                    'Pemakaian Air Berlebih' => 'https://images.unsplash.com/photo-1548839140-29a749e1cf4d?auto=format&fit=crop&q=80&w=800',
                                    'Sampah Tak Terkelola' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&q=80&w=800'
                                ]; @endphp
                            <img src="{{ $defaultImages[$problem->title] ?? 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $problem->title }}" class="w-full h-full object-cover">
                        @endif
                        <div class="absolute inset-0 bg-{{ $problem->bg_color_class ?? 'emerald' }}-600/10"></div>
                    </div>
                    <div class="p-8">
                        <div class="w-12 h-12 bg-{{ $problem->bg_color_class ?? 'emerald' }}-50 text-{{ $problem->bg_color_class ?? 'emerald' }}-600 rounded-xl flex items-center justify-center text-xl mb-4">
                            <i class="{{ $problem->icon_class ?? 'fas fa-leaf' }}"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">{{ $problem->title }}</h3>
                        <p class="text-slate-500">{{ $problem->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    
    <section class="py-20 relative overflow-hidden bg-white">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-emerald-50/50 -skew-x-12 transform origin-right"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-bold mb-4">
                    <i class="fas fa-robot animate-bounce"></i>
                    Teknologi AI Terkini
                </div>
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Solusi Cerdas dengan <span class="gradient-text">Artificial Intelligence</span></h2>
                <p class="text-slate-600 max-w-2xl mx-auto">Kami mengintegrasikan kecerdasan buatan untuk memberikan pengalaman personal dalam menjaga lingkungan.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                
                <div class="group bg-white rounded-3xl shadow-xl shadow-slate-100 border border-slate-100 overflow-hidden hover:border-emerald-500 transition-all duration-500 hover:-translate-y-2">
                    <div class="h-64 overflow-hidden bg-emerald-50 relative">
                        <img src="https://images.unsplash.com/photo-1675557009875-436f297b9a6e?auto=format&fit=crop&q=80&w=800" alt="AI Assistant Illustration" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
                    </div>
                    <div class="p-10 pt-0">
                        <div class="w-16 h-16 bg-emerald-500 text-white rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-lg shadow-emerald-200 -mt-8 relative z-10">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-slate-900">AI Assistant 24/7</h3>
                        <p class="text-slate-600 text-lg mb-6 leading-relaxed">
                            Punya pertanyaan seputar lingkungan? AI Assistant kami siap membantu menjawab cara mengolah sampah, tips hemat energi, hingga solusi gaya hidup hijau kapan saja.
                        </p>
                        <div class="flex items-center gap-2 text-emerald-600 font-bold">
                            <span>Personal Advisor</span>
                            <i class="fas fa-arrow-right text-sm"></i>
                        </div>
                    </div>
                </div>

                
                <div class="group bg-white rounded-3xl shadow-xl shadow-slate-100 border border-slate-100 overflow-hidden hover:border-blue-500 transition-all duration-500 hover:-translate-y-2">
                    <div class="h-64 overflow-hidden bg-blue-50 relative">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800" alt="AI Insight Illustration" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
                    </div>
                    <div class="p-10 pt-0">
                        <div class="w-16 h-16 bg-blue-500 text-white rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-lg shadow-blue-200 -mt-8 relative z-10">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-slate-900">AI Personal Insight</h3>
                        <p class="text-slate-600 text-lg mb-6 leading-relaxed">
                            Dapatkan analisis mendalam dari data penggunaan harianmu. AI Insight memberikan rekomendasi spesifik yang dipersonalisasi untuk membantu kamu mencapai target Eco Score.
                        </p>
                        <div class="flex items-center gap-2 text-blue-600 font-bold">
                            <span>Data Driven Analytics</span>
                            <i class="fas fa-arrow-right text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section id="cara-kerja" class="py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2">
                    <img src="https://img.freepik.com/free-vector/save-energy-concept-illustration_114360-5834.jpg" alt="Eco Solution" class="rounded-3xl shadow-lg">
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-bold text-slate-900 mb-6">EcoTrack: Solusi Digital Untuk Hidup Lebih Berkelanjutan</h2>
                    <p class="text-lg text-slate-600 mb-8">
                        Kami menghadirkan platform cerdas yang membantu kamu mengubah kebiasaan buruk menjadi gaya hidup ramah lingkungan melalui data yang akurat dan terukur.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-4">
                            <div class="w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xs"><i class="fas fa-check"></i></div>
                            <span class="text-slate-700 font-medium">Monitoring real-time penggunaan energi</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <div class="w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xs"><i class="fas fa-check"></i></div>
                            <span class="text-slate-700 font-medium">Sistem Eco Score untuk mengukur kepedulian</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <div class="w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xs"><i class="fas fa-check"></i></div>
                            <span class="text-slate-700 font-medium">AI Assistant & Personal Insight berbasis data</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    
    <section id="manfaat" class="py-20 bg-emerald-900 text-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-4xl font-bold mb-6">Mulai Gaya Hidup Hemat dan Ramah Lingkungan Hari Ini</h2>
            <p class="text-emerald-100 text-lg mb-10">Bergabunglah dengan ribuan orang lainnya yang telah berkontribusi nyata untuk masa depan bumi yang lebih hijau.</p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-emerald-900 px-12 py-4 rounded-full font-bold text-xl hover:bg-emerald-50 transition-all shadow-2xl">Buat Akun Gratis</a>
        </div>
    </section>

    <footer class="py-10 border-t border-slate-100 text-center text-slate-500">
        <p>&copy; 2026 EcoTrack. Smart Solution for Sustainable Living.</p>
    </footer>
</body>
</html>
