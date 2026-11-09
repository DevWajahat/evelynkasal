@extends('layouts.admin.app', ['title' => 'Manage About Page - Author Section'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-slate-800">About Page - Main Section</h2>
            <p class="text-xs text-slate-500">Manage heading, portrait picture, and author biography for the dedicated about page.</p>
        </div>
        <a href="{{ route('admin.cms.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition-colors">
            <i class="fa fa-arrow-left"></i>
            <span>Back to Sections</span>
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

    <form action="{{ route('admin.cms.meta.about-page.save') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
            <div class="space-y-6 lg:col-span-5">
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">Author Portrait</h3>

                    @if(!empty($metas['author_image']))
                    <div class="relative overflow-hidden rounded-xl border-2 border-slate-800 bg-slate-50 p-2 text-center">
                        <img id="aboutImagePreview" src="{{ $metas['author_image'] }}" alt="Author Image" class="mx-auto h-72 w-full object-cover rounded-lg">
                        <span class="absolute top-4 left-4 rounded bg-black/60 px-2 py-0.5 text-[10px] font-semibold text-white">Current Portrait</span>
                    </div>
                    @else
                    <div id="aboutPreviewContainer" class="hidden relative overflow-hidden rounded-xl border-2 border-slate-800 bg-slate-50 p-2 text-center">
                        <img id="aboutImagePreview" src="" alt="Preview" class="mx-auto h-72 w-full object-cover rounded-lg">
                    </div>
                    @endif

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Upload Author Photo</label>
                        <input type="file" name="author_image" id="aboutPhotoInput" accept="image/*"
                            class="mt-1.5 block w-full text-xs text-slate-500 file:mr-3 file:rounded-md file:border-0 file:bg-brand-50 file:py-2 file:px-3 file:text-xs file:font-semibold file:text-brand-600 hover:file:bg-brand-100">
                        <p class="mt-1.5 text-[11px] text-slate-400">Supported formats: JPG, PNG, WEBP (Max: 5MB).</p>
                        @error('author_image')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-600 px-4 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-brand-500 transition-colors">
                        <i class="fa fa-floppy-disk"></i>
                        <span>Save About Page Section</span>
                    </button>
                </div>
            </div>

            <div class="space-y-6 lg:col-span-7">
                <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm space-y-5">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">Heading & Biography</h3>

                    <div>
                        <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Section Title <span class="text-rose-500">*</span></label>
                        <input type="text" id="title" name="title" required
                            value="{{ old('title', $metas['title'] ?? 'ABOUT THE AUTHOR') }}"
                            placeholder="ABOUT THE AUTHOR"
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-base font-extrabold tracking-wide text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">
                        @error('title')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Full Biography Content <span class="text-rose-500">*</span></label>
                        <textarea id="description" name="description" rows="12" required
                            placeholder="Enter the author's background, accomplishments, and narrative paragraphs..."
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm leading-relaxed text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">{{ old('description', $metas['description'] ?? '') }}</textarea>
                        <p class="mt-1 text-[11px] text-slate-400">Paragraph spacing is preserved directly via line breaks.</p>
                        @error('description')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('aboutPhotoInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.getElementById('aboutImagePreview');
                const container = document.getElementById('aboutPreviewContainer');
                if (img) img.src = event.target.result;
                if (container) container.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
