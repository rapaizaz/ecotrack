<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EcoTrack</title>
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
                    <i class="fas fa-leaf"></i>
                </div>
                <h1 class="text-2xl font-bold">Selamat Datang Kembali</h1>
                <p class="text-emerald-100 text-sm">Masuk untuk melanjutkan monitoring lingkunganmu.</p>
            </div>
            
            <div class="p-8">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl text-sm border border-red-100">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none pl-12" placeholder="nama@email.com">
                            <div class="absolute left-4 top-3.5 text-slate-400"><i class="fas fa-envelope"></i></div>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <div class="flex justify-between mb-2">
                            <label class="text-sm font-bold text-slate-700">Password</label>
                            <a href="#" class="text-xs text-emerald-600 font-semibold">Lupa Password?</a>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none pl-12" placeholder="••••••••">
                            <div class="absolute left-4 top-3.5 text-slate-400"><i class="fas fa-lock"></i></div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 mb-6">
                        Masuk Sekarang
                    </button>

                    <div class="text-center text-sm text-slate-500">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-emerald-600 font-bold">Daftar Gratis</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
