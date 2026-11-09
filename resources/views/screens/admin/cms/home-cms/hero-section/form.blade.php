@extends('layouts.admin.app', ['title' => 'Manage Hero Section'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-slate-800">Home Hero Section</h2>
            <p class="text-xs text-slate-500">Create or modify hero banner text, call-to-action buttons, and background visuals.</p>
        </div>
        <a href="{{-- route('index') --}}#" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition-colors">
            <i class="fa fa-arrow-left"></i>
            <span>Back to Dashboard</span>
        </a>
    </div>

    @if(session('success'))
    <div class="flex items-center justify-between rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs text-emerald-800">
        <div class="flex items-center gap-2">
            <i class="fa fa-circle-check text-sm text-emerald-600"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800">
            <i class="fa fa-xmark"></i>
        </button>
    </div>
    @endif

    <form action="{{ route('admin.cms.meta.herosection.save') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm space-y-5">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">Copy & Headline</h3>

                    <div>
                        <label for="badge" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Top Badge / Subtitle</label>
                        <input type="text" id="badge" name="badge"
                            value="{{ old('badge', $metas['badge'] ?? '') }}"
                            placeholder="e.g. New York Times Bestseller"
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">
                        @error('badge')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Main Title <span class="text-rose-500">*</span></label>
                        <input type="text" id="title" name="title" required
                            value="{{ old('title', $metas['title'] ?? '') }}"
                            placeholder="e.g. Stories That Transcend Boundaries"
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">
                        @error('title')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Hero Description</label>
                        <textarea id="description" name="description" rows="4"
                            placeholder="Write a short summary introducing the author, latest release, or tagline..."
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">{{ old('description', $metas['description'] ?? '') }}</textarea>
                        @error('description')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm space-y-5">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">Call to Action Button</h3>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="button_text" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Button Label</label>
                            <input type="text" id="button_text" name="button_text"
                                value="{{ old('button_text', $metas['button_text'] ?? '') }}"
                                placeholder="e.g. Order My New Book"
                                class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">
                            @error('button_text')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="button_link" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Target URL</label>
                            <input type="text" id="button_link" name="button_link"
                                value="{{ old('button_link', $metas['button_link'] ?? '') }}"
                                placeholder="e.g. /books or https://amazon.com/..."
                                class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">
                            @error('button_link')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm space-y-4">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">Background Image</h3>

                    @if(!empty($metas['background_image']))
                    <div class="relative overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
                        <img id="imagePreview" src="{{ $metas['background_image'] }}" alt="Hero Background" class="h-44 w-full object-cover">
                        <span class="absolute top-2 left-2 rounded bg-black/60 px-2 py-0.5 text-[10px] font-semibold text-white backdrop-blur-sm">Current Asset</span>
                    </div>
                    @else
                    <div id="previewContainer" class="hidden relative overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
                        <img id="imagePreview" src="" alt="Preview" class="h-44 w-full object-cover">
                    </div>
                    @endif

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Upload New Image</label>
                        <input type="file" name="background_image" id="backgroundImageInput" accept="image/*"
                            class="mt-1.5 block w-full text-xs text-slate-500 file:mr-3 file:rounded-md file:border-0 file:bg-brand-50 file:py-2 file:px-3 file:text-xs file:font-semibold file:text-brand-600 hover:file:bg-brand-100">
                        <p class="mt-1.5 text-[11px] text-slate-400">Supported formats: JPG, PNG, WEBP, SVG (Max: 5MB).</p>
                        @error('background_image')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm">
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-600 px-4 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-brand-500 transition-colors">
                        <i class="fa fa-floppy-disk"></i>
                        <span>Save Hero Changes</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('backgroundImageInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.getElementById('imagePreview');
                const container = document.getElementById('previewContainer');
                if (img) {
                    img.src = event.target.result;
                }
                if (container) {
                    container.classList.remove('hidden');
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
