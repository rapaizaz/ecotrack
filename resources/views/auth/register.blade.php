<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - EcoTrack</title>
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
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1 class="text-2xl font-bold">Buat Akun EcoTrack</h1>
                <p class="text-emerald-100 text-sm">Bergabunglah untuk masa depan bumi yang lebih hijau.</p>
            </div>
            
            <div class="p-8">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl text-sm border border-red-100">
                        <ul class="list-disc pl-4">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none pl-12" placeholder="Masukkan nama kamu">
                            <div class="absolute left-4 top-3.5 text-slate-400"><i class="fas fa-user"></i></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none pl-12" placeholder="nama@email.com">
                            <div class="absolute left-4 top-3.5 text-slate-400"><i class="fas fa-envelope"></i></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none pl-12" placeholder="Minimal 8 karakter">
                            <div class="absolute left-4 top-3.5 text-slate-400"><i class="fas fa-lock"></i></div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 outline-none pl-12" placeholder="Ulangi password">
                            <div class="absolute left-4 top-3.5 text-slate-400"><i class="fas fa-shield-alt"></i></div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 mb-6">
                        Daftar Akun
                    </button>

                    <div class="text-center text-sm text-slate-500">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-emerald-600 font-bold">Masuk Sekarang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
