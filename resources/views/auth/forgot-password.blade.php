<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - EcoTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-50">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
            <div class="p-8 text-center bg-emerald-600 text-white">
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4 backdrop-blur-sm">
                    <i class="fas fa-key"></i>
                </div>
                <h1 class="text-2xl font-bold">Lupa Password</h1>
                <p class="text-emerald-100 text-sm">Masukkan email Anda untuk menyetel ulang password.</p>
            </div>
            
            <div class="p-8">
                @if(session('status'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-800 rounded-xl text-sm border border-emerald-100">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-check-circle mt-0.5 text-emerald-600"></i>
                            <div>
                                {{ session('status') }}
                            </div>
                        </div>
                        
                        @if(session('reset_link'))
                            <div class="mt-4 pt-3 border-t border-emerald-200/50">
                                <p class="text-xs text-emerald-700 font-semibold mb-2"><i class="fas fa-info-circle mr-1"></i> Mode Lokal Terdeteksi:</p>
                                <a href="{{ session('reset_link') }}" class="inline-flex items-center justify-center w-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold py-2.5 px-4 rounded-xl transition-all shadow-md shadow-emerald-100">
                                    Reset Password Sekarang <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl text-sm border border-red-100">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-exclamation-circle mt-0.5"></i>
                            <div>
                                {{ $errors->first() }}
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none pl-12" placeholder="nama@email.com">
                            <div class="absolute left-4 top-3.5 text-slate-400"><i class="fas fa-envelope"></i></div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 mb-6">
                        Kirim Link Reset
                    </button>

                    <div class="text-center text-sm text-slate-500">
                        Ingat password Anda? <a href="{{ route('login') }}" class="text-emerald-600 font-bold">Masuk</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
