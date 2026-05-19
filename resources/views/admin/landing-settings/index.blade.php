@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900">Landing Page Settings 🎨</h1>
    <p class="text-slate-500">Kelola tampilan Hero Section di halaman depan EcoTrack.</p>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3 animate-fade-in">
    <i class="fas fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
            <form action="{{ route('admin.landing-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 text-center uppercase tracking-wider">Upload New Hero Image</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-64 border-2 border-slate-300 border-dashed rounded-3xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all overflow-hidden relative">
                                <div id="preview-container" class="absolute inset-0 flex items-center justify-center hidden">
                                    <img id="image-preview" src="#" alt="Preview" class="w-full h-full object-cover">
                                </div>
                                <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-slate-400 mb-4"></i>
                                    <p class="mb-2 text-sm text-slate-500 font-bold">Klik untuk upload atau drag and drop</p>
                                    <p class="text-xs text-slate-400">PNG, JPG, JPEG, atau WEBP (Maks. 2MB)</p>
                                </div>
                                <input type="file" name="hero_image" class="hidden" onchange="previewImage(this)">
                            </label>
                        </div>
                        @error('hero_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold mb-4 uppercase tracking-wider text-slate-500 text-xs">Hero Image Preview</h3>
            <div class="rounded-2xl overflow-hidden border border-slate-100 bg-slate-50 aspect-video flex items-center justify-center">
                @if($setting && $setting->hero_image_path)
                    <img src="{{ asset('storage/' . $setting->hero_image_path) }}" alt="Current Hero" class="w-full h-full object-cover">
                @else
                    <div class="text-center p-6">
                        <i class="fas fa-image text-4xl text-slate-300 mb-3"></i>
                        <p class="text-sm text-slate-400 italic">Gambar default (Freepik)</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-12 mb-8">
    <h2 class="text-2xl font-bold text-slate-900">Kelola Kartu Masalah 🧩</h2>
    <p class="text-slate-500">Atur judul, deskripsi, dan gambar untuk 3 kartu masalah di landing page.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
    @foreach($problems as $index => $problem)
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
        <div class="h-40 bg-slate-100 relative group">
            @if($problem->image_path)
                <img src="{{ asset('storage/' . $problem->image_path) }}" alt="{{ $problem->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                    <i class="fas fa-image text-3xl mb-2"></i>
                    <p class="text-xs uppercase font-bold">Default Image</p>
                </div>
            @endif
            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white font-bold text-sm">
                Card #{{ $index + 1 }}
            </div>
        </div>
        
        <div class="p-6 flex-1">
            <form action="{{ route('admin.landing-settings.update-problem', $problem->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Judul Kartu</label>
                        <input type="text" name="title" value="{{ $problem->title }}" 
                               class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-emerald-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Keterangan / Deskripsi</label>
                        <textarea name="description" rows="3" 
                                  class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-emerald-500 text-sm">{{ $problem->description }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Ganti Gambar</label>
                        <input type="file" name="image" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    </div>
                    <button type="submit" class="w-full bg-slate-900 text-white font-bold py-2.5 rounded-xl text-sm hover:bg-slate-800 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-sync-alt text-xs"></i> Update Kartu
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
