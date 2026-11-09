@extends('layouts.admin.app', ['title' => 'Manage Featured Book Section'])

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-slate-800">Featured Book & Showcase Section</h2>
            <p class="text-xs text-slate-500">Configure the primary book display, multiple preview angles, author blurb, and purchasing CTA.</p>
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

    <form action="{{ route('admin.cms.meta.featured-book.save') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
            <div class="space-y-6 lg:col-span-5">
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">1. Main Book Cover</h3>

                    @if(!empty($metas['featured_image']))
                    <div class="relative overflow-hidden rounded-lg border border-slate-200 bg-slate-50 p-2 text-center">
                        <img id="featuredPreview" src="{{ $metas['featured_image'] }}" alt="Featured Book" class="mx-auto h-64 object-contain">
                        <span class="absolute top-2 left-2 rounded bg-black/60 px-2 py-0.5 text-[10px] font-semibold text-white">Current Cover</span>
                    </div>
                    @else
                    <div id="featuredPreviewContainer" class="hidden relative overflow-hidden rounded-lg border border-slate-200 bg-slate-50 p-2 text-center">
                        <img id="featuredPreview" src="" alt="Preview" class="mx-auto h-64 object-contain">
                    </div>
                    @endif

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Upload Featured Cover</label>
                        <input type="file" name="featured_image" id="featuredImageInput" accept="image/*"
                            class="mt-1.5 block w-full text-xs text-slate-500 file:mr-3 file:rounded-md file:border-0 file:bg-brand-50 file:py-2 file:px-3 file:text-xs file:font-semibold file:text-brand-600 hover:file:bg-brand-100">
                        @error('featured_image')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">2. Gallery & Alternative Angles (Multiple)</h3>

                    @if(!empty($galleryImages) && count($galleryImages) > 0)
                    <div class="grid grid-cols-3 gap-3">
                        @foreach($galleryImages as $img)
                        <div class="relative group rounded-lg border border-slate-200 bg-slate-50 p-1">
                            <img src="{{ $img }}" alt="Thumbnail" class="h-20 w-full object-contain">
                            <button type="submit" form="deleteGalleryForm_{{ $loop->index }}" class="absolute top-1 right-1 rounded-full bg-rose-600 p-1 text-white opacity-90 hover:opacity-100 transition-opacity" title="Remove image">
                                <i class="fa fa-times text-[10px]"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Add More Thumbnails</label>
                        <input type="file" name="gallery_images[]" multiple accept="image/*"
                            class="mt-1.5 block w-full text-xs text-slate-500 file:mr-3 file:rounded-md file:border-0 file:bg-brand-50 file:py-2 file:px-3 file:text-xs file:font-semibold file:text-brand-600 hover:file:bg-brand-100">
                        <p class="mt-1 text-[11px] text-slate-400">Select one or multiple image files (front, spine, back preview).</p>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm space-y-4">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">3. Lower Details (Badge, Author & Rating)</h3>

                    <div>
                        <label for="badge" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Category Badge</label>
                        <input type="text" id="badge" name="badge"
                            value="{{ old('badge', $metas['badge'] ?? '') }}"
                            placeholder="MEMOIR & AUTOBIOGRAPHY"
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-brand-500 focus:outline-none">
                    </div>

                    <div>
                        <label for="left_title" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Lower Book Title</label>
                        <input type="text" id="left_title" name="left_title"
                            value="{{ old('left_title', $metas['left_title'] ?? '') }}"
                            placeholder="RARE EDITION: HOW MANY UNUSUAL EVENTS IN ONE LIFE?"
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-brand-500 focus:outline-none">
                    </div>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <div>
                            <label for="author_name" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Author Name</label>
                            <input type="text" id="author_name" name="author_name"
                                value="{{ old('author_name', $metas['author_name'] ?? '') }}"
                                placeholder="Evelyn Kasal"
                                class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-brand-500 focus:outline-none">
                        </div>

                        <div>
                            <label for="rating" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Star Rating (1 - 5)</label>
                            <select id="rating" name="rating" class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-800 focus:border-brand-500 focus:outline-none">
                                @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ old('rating', $metas['rating'] ?? 5) == $i ? 'selected' : '' }}>
                                    {{ $i }} Stars (★★★★★)
                                </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Author Avatar / Round Photo</label>
                        <div class="mt-1.5 flex items-center gap-3">
                            @if(!empty($metas['author_photo']))
                            <img src="{{ $metas['author_photo'] }}" alt="Author" class="h-10 w-10 rounded-full object-cover border border-slate-300">
                            @endif
                            <input type="file" name="author_photo" accept="image/*"
                                class="block w-full text-xs text-slate-500 file:mr-3 file:rounded-md file:border-0 file:bg-brand-50 file:py-1.5 file:px-3 file:text-xs file:font-semibold file:text-brand-600 hover:file:bg-brand-100">
                        </div>
                    </div>

                    <div class="pt-2 border-t border-slate-100 space-y-3">
                        <div>
                            <label for="button_text" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Button Text</label>
                            <input type="text" id="button_text" name="button_text"
                                value="{{ old('button_text', $metas['button_text'] ?? 'BUY NOW') }}"
                                placeholder="BUY NOW"
                                class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-brand-500 focus:outline-none">
                        </div>

                        <div>
                            <label for="button_link" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Button Link</label>
                            <input type="text" id="button_link" name="button_link"
                                value="{{ old('button_link', $metas['button_link'] ?? '') }}"
                                placeholder="https://amazon.com/dp/..."
                                class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-800 focus:border-brand-500 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6 lg:col-span-7">
                <div class="rounded-xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm space-y-5">
                    <h3 class="border-b border-slate-100 pb-3 text-sm font-semibold text-slate-800">4. Right Column Narrative & Typography</h3>

                    <div>
                        <label for="right_title" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Main Title <span class="text-rose-500">*</span></label>
                        <textarea id="right_title" name="right_title" rows="2" required
                            placeholder="RARE EDITION: HOW MANY UNUSUAL EVENTS IN ONE LIFE?"
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-base font-bold text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">{{ old('right_title', $metas['right_title'] ?? '') }}</textarea>
                        @error('right_title')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="right_intro" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Italic Highlight / Hook Quote</label>
                        <textarea id="right_intro" name="right_intro" rows="3"
                            placeholder="Dive into an intimate look at one woman's remarkable journey through the unexpected turns that shaped her extraordinary story."
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm italic text-slate-700 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">{{ old('right_intro', $metas['right_intro'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="right_description" class="block text-xs font-semibold uppercase tracking-wider text-slate-600">Full Description Paragraphs</label>
                        <textarea id="right_description" name="right_description" rows="10"
                            placeholder="Enter the full book synopses, background story, and paragraphs..."
                            class="mt-1.5 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm leading-relaxed text-slate-800 focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500">{{ old('right_description', $metas['right_description'] ?? '') }}</textarea>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg bg-brand-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-brand-500 transition-colors">
                        <i class="fa fa-floppy-disk"></i>
                        <span>Save Featured Book Section</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@if(!empty($galleryImages))
    @foreach($galleryImages as $img)
    <form id="deleteGalleryForm_{{ $loop->index }}" action="{{ route('admin.cms.meta.featured-book.gallery.delete') }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
        <input type="hidden" name="image_url" value="{{ $img }}">
    </form>
    @endforeach
@endif

<script>
    document.getElementById('featuredImageInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.getElementById('featuredPreview');
                const container = document.getElementById('featuredPreviewContainer');
                if (img) img.src = event.target.result;
                if (container) container.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
